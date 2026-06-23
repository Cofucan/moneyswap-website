<?php

namespace Modules\ClientManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Instruction;
use Modules\ClientManagement\Entities\Client;
use Modules\ClientManagement\Entities\Cohort;
use Modules\AccountManagement\Traits\WalletTrait;
use Modules\CatalogManagement\Entities\Program;
use Modules\ProfileManagement\Entities\Religion;
use Modules\CatalogManagement\Entities\Cause;
use Modules\ProfileManagement\Entities\Agent;
use Modules\ProfileManagement\Entities\Relationship;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\ClientManagement\Entities\ClientCategory;
use Modules\OrganizationManagement\Entities\Outlet;
use Modules\ClientManagement\Traits\ClientTrait;
use Illuminate\Http\Request;
use Modules\ClientManagement\Exports\ClientsExport;
use Modules\ClientManagement\Imports\ClientsImport;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use File;
use PDF;
use Image;

class ClientController extends Controller
{
    use ClientTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manage()
    {
        // $total = $this->studentstats();
        $programs = Program::active()->pluck("label", "id");
        $clients = Client::mine()->get();
        $clientcategories = ClientCategory::active()->pluck("label", "id");
        return view('clientmanagement::clients.manage', compact('clients', 'clientcategories','programs'));
    }

    public function manifest($status)
    {
        $clients = Client::byStatus($status)->get()
                            ->groupBy(function($item) {
                                return $item->cause->label;
                            });
        $clientcategories = ClientCategory::active()->pluck("label", "id");
        $levels = Program::active()->get();
        $batches = Batch::active()->get();
        return view('clientmanagement::clients.manifest', compact('clients','status', 'levels','batches','clientcategories'));
    }

    public function gradefilter(Request $request)
    {
        $this->validate($request, [
            'grade_id' => 'required',
            'status' => 'required'
        ]);
        $status = $request->status;
        $level = Program::findOrFail($request->grade_id);
        $clients = Client::build($level->id,$status)->get();
        return view('clientmanagement::clients.level', compact('clients', 'level', 'status'));
    }

    public function gradeprinter(Request $request)
    {
        $this->validate($request, [
            'grade_id' => 'required',
            'status' => 'required'
        ]);
        $status = $request->status;
        $level = Program::findOrFail($request->grade_id);
        $clients = Client::build($level->id,$status)->get();
        $label = $status . ' ' . $level->label . ' Clients';
        return view('clientmanagement::clients.printer', compact('clients', 'label'));
    }
    public function export()
    {
        return Excel::download(new StudentsExport, 'clients.xlsx');
    }

    public function upload()
    {
        $batches = Batch::active()->pluck("label", "id");
        $outlets = Outlet::active()->pluck("label", "id");
        return view('clientmanagement::clients.upload', compact('outlets','batches'));
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'outlet_id' => 'required',
            'academic_term_id' => 'required',
            'batch_id' => 'required'
         ]);
        if(isset($request->cohort_id)){
            $cohort = Cohort::findOrFail($request->cohort_id);
        }else{

            $this->data = $request->all();
            $cohort = $this->saveCohort();
        }
        if(!$cohort)
        {
            return redirect()->back()->with('error', 'Clients set cannot be created');
        }
        $import = new StudentsImport($cohort);
        //$file = $request->file('file')->store('import');
        $file = $request->file('file');
        Excel::import($import, $file);
        return redirect()->route('cohorts.show', $cohort)->with('success','Review and submit for approval.');
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'value' => 'required',
             'criteria' => 'required'
         ]);
         if($request->criteria == 'Phone')
         {
            $sponsor = $this->phonesearch($request->value);
         }
         try {
            $client = Client::where('student_code', $request->student_code);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->route('clients.show', $client->id);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
               $outlets = Outlet::withCount([
            'Learners',
            'Staff',
            'Learners as boarding_students_count' => function ($query) {
                $query->where('client_category_id', 3);
            },
            'Learners as day_students_count' => function ($query) {
                $query->where('client_category_id', 1);
            }])->get();
        $levels = Program::active()->get();
        $total = $this->studentstats();
        //$clients->groupBy(['skilllevel','teacher']);
        return view('clientmanagement::clients.index', compact('total', 'levels', 'outlets'));
    }


    /**
     * Show the form for creat ing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $instruction = Instruction::byTag('addclient');
            $agents = Agent::active()->get();
            //$agent = Agent::details();
            $relationships = Relationship::all()->pluck("label", "id");
            $programs = Program::active()->pluck("label", "id");
            $clientcategories = ClientCategory::active()->pluck("label", "id");
            $outlets = Outlet::active()->pluck("label", "id");
            $countries = Country::all()->pluck("citizen_title", "code");
            return view('clientmanagement::clients.create',
                        compact('clientcategories', 'agents',
                        'relationships', 'programs', 'outlets', 'instruction'));

    }

    public function new(Agent $agent)
    {
        $instruction = Instruction::byTag('addclient');
        $relationships = Relationship::all()->pluck("label", "id");
        $causes = Cause::active()->pluck("label", "id");
        $countries = Country::all()->pluck("label", "code");
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];
        $states = State::all()->pluck("state_name", "id");
        $religions = Religion::active()->pluck("label", "id");
        $clientcategories = ClientCategory::active()->pluck("overview", "id");
        return view('clientmanagement::clients.new',
        compact('agent','relationships', 'causes', 'instruction', 'states', 'religions', 'addressPrefix', 'countries','clientcategories'));
    }

    public function getbatchstudents(Request $request)
    {
        $batch = $request->batch;
        $clients = Client::active()->where('batch_id', $batch)->get()->pluck("label","id");
        return response()->json($clients);
    }

    public function add(Cohort $cohort)
    {
        //
            $agents = Agent::active()->get();
            $relationships = Relationship::all()->pluck("label", "id");
            $clientcategories = ClientCategory::active()->pluck("label", "id");
            $transactionmethods = TransactionMethod::active()->pluck("label", "id");
            $countries = Country::all()->pluck("citizen_title", "code");
            return view('clientmanagement::clients.create',
                        compact('cohort', 'transactionmethods', 'clientcategories', 'agents', 'relationships'));

    }


    public function process(Request $request)
    {
        $this->validate($request, [
           'orphan_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        $client = $this->processStudent();
        if(!$client)
        {
            return redirect()->back()->with('error','Something went wrong, please try again');
        }
        return redirect()->route('clients.show', $client)->with('success','Action performed successfully.');
    }
    public function activate(Request $request)
    {
        $this->validate($request, [
           'orphan_id' => 'required',
           'batch_id' => 'required',
           'client_category_id' => 'required',
            'academic_term_id' => 'required'
        ]);
        $this->data = $request->all();
        $client = $this->activator();
        if($client)
        {
            return redirect()->route('clients.show', $client)->with('success','Kindly review and click submit to confirm enrolment.');
        }
        return redirect()->back()->with('error','Operation Aborted');
    }

    public function change(Request $request)
    {
        $this->validate($request, [
           'orphan_id' => 'required',
           'client_category_id' => 'required'
        ]);
        $this->data = $request->all();
        $client = $this->makeChange();
        if($client)
        {
            return redirect()->route('clients.show', $client)->with('success','Kindly review and click submit to confirm enrolment.');
        }
        return redirect()->back()->with('error','Operation Aborted');
    }

    public function activation(Request $request)
    {
        $this->validate($request, [
            'batch_id' => 'required',
            'academic_term_id' => 'required'
        ]);
        $level = Program::findOrFail($request->grade_id);
        $clients = Client::inActive($request->grade_id)->get();
        $levels = Program::Active()->get();
        return view('clientmanagement::clients.activation', compact('clients', 'levels', 'level'));
    }
    public function deactivation(Request $request)
    {
        $this->validate($request, [
            'orphan_id' => 'required'
        ]);
        $this->data = $request->all();
        $client = $this->deactivate();
        if($client)
        {
            return redirect()->back()->with('success','Client Profile deactivated successfully.');
            //return redirect()->route('clients.show', $client)->with('success','operation completed successfully.');
        }
        return redirect()->back()->with('error','Operation Aborted');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
            //    dd($request->all());
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'program_id' => 'required'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('avatar')) {
            $this->avatar = $request->file('avatar');
        }
        if(isset($request->street_name) && isset($request->neighbourhood_name))
        {
            $address = $this->saveAddress();
            $request->merge([
                'address_id' => $address->id
            ]);
        }
        $client = $this->saveClient();
        if (!$client){
            return redirect()->back()->with('error', 'Something went wrong. please check your data and try again');
        }
        return redirect()->route('kindreds.new', $client)->with('success','Client Record Created and submitted for approval.');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
        if($client->status == 'Draft' || $client->status == 'Scheduled' )
        {
            return redirect()->route('clients.review', $client);
        }
        $addressTypes = [
            'Home' => 'Home',
            'Work' => 'Work'
        ];
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
        ];
        //$this->MakeVirtualAccount($client->profile);
        //$clientcategories = ClientCategory::active()->pluck("label", "id");
        $states = State::all()->plucK("state_name", "id");
        //$transactionchannels = TransactionChannel::Online(false)->get();
        $countries = Country::all()->pluck("citizen_title", "country_code");
        return view('clientmanagement::clients.show',compact('client', 'countries','states', 'addressTypes', 'addressPrefix'));
    }

    public function review(Client $client)
    {
        //
        $addressTypes = [
            'Home' => 'Home',
            'Work' => 'Work'
        ];
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
        ];
        $clientcategories = ClientCategory::active()->pluck("label", "id");
        $states = State::all()->plucK("state_name", "id");
        $countries = Country::all()->pluck("citizen_title", "country_code");
        return view('clientmanagement::clients.review',compact('client', 'countries', 'clientcategories','states', 'addressTypes', 'addressPrefix'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
        $cohorts = Cohort::available()->get()->pluck("label", "id");
        $transactionmethods = TransactionMethod::active()->pluck("label", "id");
        $clientcategories = ClientCategory::active()->pluck("label", "id");
        return view('clientmanagement::clients.edit',compact('client', 'clientcategories', 'batches', 'transactionmethods', 'cohorts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
        $this->validate($request, [
            'client_category_id' => 'required',
            'batch_id' => 'required'
        ]);
        if(!$client->update($request->all()))
        {
            return redirect()->back()->with('error','Something went wrong, please try again later');
        }
        return redirect()->back()->with('success','Client Record Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if($client->status == 'Draft')
        {
            $client->delete();
            return redirect()->back()
                        ->with('success','Client Record Deleted Duccessfully');
        }
        return redirect()->back()->with('error','Active record cannot be deleted');
    }
}
