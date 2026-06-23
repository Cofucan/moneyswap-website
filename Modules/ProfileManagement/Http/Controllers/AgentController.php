<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\LocationManagement\Entities\Country;
use Modules\InvoiceManagement\Entities\Invoice;
use Modules\ClientManagement\Entities\Client;
use Modules\CommunicationManagement\Entities\Announcement;
use Modules\CommunicationManagement\Entities\Communication;
use Modules\OrganizationManagement\Entities\Occupation;
use Modules\ProfileManagement\Entities\Profile;
use Modules\ProfileManagement\Entities\Relationship;
use Modules\ProfileManagement\Entities\Religion;
use Modules\LocationManagement\Entities\State;
use Modules\ProfileManagement\Entities\Agent;
use Modules\ProfileManagement\Traits\AgentTrait;
use Modules\ProfileManagement\Exports\AgentsExport;
use Modules\ProfileManagement\Imports\AgentsImport;
use Illuminate\Http\Request;
use Auth;
use Excel;
use File;
use Session;

class AgentController extends Controller
{
    use AgentTrait;

    public function __construct()
    {
        // $this->middleware(['auth','verified']);


    }
    public function upload()
    {
       return view('profilemanagement::agents.upload');
    }

    public function export()
    {
        return Excel::download(new AgentsExport, 'agents.xlsx');
    }

    public function import()
    {
        Excel::import(new AgentsImport, request()->file('file'));
        return redirect()->back()->with('success', 'Data imported successfully');
    }

    // use RegistersUsers;
     /**
     * Where to redirect users after registration.
     *
     * @var string
     */
public function home($famlyId = null)
{
    $profile = Auth::user()->profile;
    $agent = $profile->Agent;
    $this->profile_id = $profile->id;
    $invoices = Invoice::upcoming()
                    ->whereHas('Client', function($item){
                    $item->where('agent_id', $this->profile_id);
                    })->orderBy('created_at', 'Desc');
    $announcements = Announcement::where('published', true)->get();
    $communications = Communication::byParent($this->profile_id)->get();
    $clients = Client::byFamily($famlyId)->get();
    return view('profilemanagement::agents.home', compact('announcements', 'agent', 'profile', 'communications', 'invoices'));
}

public function preview(Agent $agent)
{
    return view('profilemanagement::agents.details', compact( 'agent'));
}



    public function find(){}
    public function search(Request $request)
    {
        $this->validate($request, [
            'user_input' => 'required',
             'criteria' => 'required'
         ]);
         if($request->criteria == 'Phone')
         {
            $agent = $this->phonesearch($request->user_input);
            //return view('profilemanagement::agents.preview', compact('agent'));
            if(is_null($agent)){
                return redirect()->back()->withInput()->withErrors('error', 'No record found');
            }
            return redirect()->route('agents.preview', $agent)->with('success','Record retrieved successfully.');
         }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];
        $regions = Country::active()->get();
        $nationalities = $regions->pluck("citizen_title", "code");
        $countries = $regions->pluck("label", "code");
        $states = State::all()->pluck("state_name", "id");
        $religions = Religion::active()->pluck("label", "id");
        return view('profilemanagement::agents.create',compact('addressPrefix','profile', 'countries', 'religions','nationalities', 'states'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /* $agents = Agent::all();
        foreach($agents as $agent)
        {
           if($agent->client->count() >0)
            {

                $batch = Batch:: whereGradeId($client->grade_id)->whereStreamId($client->stream_id)->first();
                $client->batch_id = $batch->id;
                $client->save();
            }
        } */
        $agents = Agent::available();
        return view('profilemanagement::agents.index', compact('agents' ));
    }

    public function manage()
    {
        $agents = Agent::available();
        return view('profilemanagement::agents.manage', compact('agents'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'telephone' => 'required',
        ]);
        $this->data = $request->all();
       $agent = $this->saveSponsor();
        if ( !$agent ) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, please try later');
        }
        return redirect()->route('agents.show', $agent)->with('success','Employee Added successfully.');
    }
    protected function new(Profile $profile)
    {
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];
            $states = State::all()->pluck("state_name", "id");
            //$occupations = Occupation::all()->pluck("label", "id");
            $religions = Religion::active()->pluck("label", "id");
            $regions = Country::active()->get();
        $nationalities = $regions->pluck("citizen_title", "code");
        $countries = $regions->pluck("label", "code");
        return view('profilemanagement::agents.new',compact('addressPrefix','profile', 'countries', 'religions','nationalities', 'states'));
    }
    public function make(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'occupation' => 'required',
        ]);
        $this->data = $request->all();
        if(isset($request->street_name) && isset($request->neighbourhood_name))
        {
            $address = $this->saveAddress();
            $request->merge([
                'address_id' => $address->id
            ]);
        }
        $profile = Profile::findOrFail($request->profile_id);
        if( !$profile->update($request->only('first_name','last_name', 'middle_name', 'birthday', 'marital_status', 'address_id', 'gender', 'country_code', 'email'))) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        $agent = $this->saveAgent();
        if (!$agent) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, please try later');
        }
        if($agent->clients->count() > 0)
        {
            return redirect()->back()->with('success','Sponsor profile created successfully.');
        }
        return redirect()->route('clients.new', $agent)->with('success','you have not norminated any orphan for scholarship!');

    }

    public function toggle(Agent $agent)
    {
        if ($agent->enabled == true) {
            $agent->enabled = false;
            $feedback = 'Agent Deactived successfully';
        } else {
            $agent->enabled = true;
            $feedback = 'Agent Activated successfully';
        }
        if ( ! $agent->save()) {
            return redirect()->back()->with('error', 'Could not update Department');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
        $contactTags = $this->contactTags();
        $phoneTags = $this->phoneTags();
        $relationships = Relationship::all()->pluck("relationship");
        $occupations = Occupation::active()->pluck("label", "id");
        $countries = Country::all()->pluck("citizen_title", "code");
        return view('profilemanagement::agents.show',compact('agent', 'countries', 'relationships', 'phoneTags', 'occupations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
        $occupations = Occupation::active()->pluck("label", "id");
        return view('profilemanagement::agents.edit',compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        //
        if( ! $agent->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Record Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
        $agent->delete();
        return redirect()->back()
                        ->with('success','agent deleted successfully');
    }
}
