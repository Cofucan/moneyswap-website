<?php
namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\Governor;
use Modules\LocationManagement\Entities\State;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;
use Image;

class GovernorController extends Controller
{
  
    public function __construct(Governor $governor)
    {
        // $this->middleware(['auth','verified']);
    }

   
   

    /**
     * View PDF on the browser
     * @return pdf [description]
     */

    public function manage()
    {
        //$counter = $this->governorStats();
        $governors = Governor::active()->get();
        return view('humanresources::governors.manage', compact('governors'));
    }

   
    public function process(Request $request)
    {
        $this->validate($request, [
           'governor_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        if($this->processGovernor())        {
            return redirect()->back()->with('success','Action performed successfully.');
        }
    }


    public function status($status)
    {
        $governors = Governor::bystatus($status)->get();
        return view('humanresources::governors.list', compact('governors', 'status'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governors = Governor::active()->paginate(12);
        return view('humanresources::governors.index', compact('governors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('humanresources::governors.create', compact('employmentTypes', 'designations'));
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
            'designation_id' => 'required',
            'employment_type_id' => 'required',
            'hired_at' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'passport_photograph.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('avatar')) {
            $this->avatar = $request->file('avatar');
        }
        $governor = $this->saveGovernor();
        if ( !$governor) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, please try later');
        }
        return redirect()->route('governors.show', $governor)->with('success','Governor Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Governor  $governor
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Governor  $governor
     * @return \Illuminate\Http\Response
     */
     public function show(Governor $governor)
     {
        $countries = Country::all()->pluck("citizen_title", "country_code");
        $qualifications = Qualification::active()->pluck('label', 'id');
        // $designations = $governor->profile->Role->department->designations->pluck('job_role', 'id');
        $designations = Designation::active()->pluck('job_role', 'id');
        $employmentTypes = EmploymentType::active()->get();
        $states = State::all()->plucK("state_name", "id");
        return view('humanresources::governors.show',compact('governor', 'countries', 'qualifications', 'states','designations', 'employmentTypes'));
     }


     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Governor  $governor
      * @return \Illuminate\Http\Response
      */
     public function edit(Governor $governor)
     {
        $employmentTypes= EmploymentType::all()->pluck("label", "id");
        $designations= Designation::active()->pluck("job_role", "id");

        $employmentStatus = [
            'Probation' => 'Probation',
            'Confirmed'  => 'Confirmed',
            'Retired'  => 'Retired',
            'Resigned' => 'Resigned'
        ];
        return view('humanresources::governors.edit',compact('governor', 'employmentTypes', 'designations', 'employmentStatus'));
     }


     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Governor  $Governor
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Governor $governor)
     {
        // dd($request->all());
        $this->validate($request, [
            'designation_id' => 'required',
            'employment_type_id' => 'required',
            'hired_at' => 'required',
            'passport_photograph.*' => 'image|mimes:jpeg,jpg,png,gif|max:2000'
        ]);
        if ( ! $governor->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try later');
        }
        return redirect()->route('governors.show', $governor)->with('success','Governor Updated successfully.');
     }
     public function preview(Governor $governor)
    {
       return view('humanresources::governors.governor',compact('governor'));
    }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Governor  $governor
      * @return \Illuminate\Http\Response
      */
     public function destroy(Governor $governor)
     {
         if($governor->allocations->count() > 0)
         {
            return redirect()->back()
            ->with('error','Please delete all associated resources before removing governor. Cannot Delete Governor Record');
         }
        $governor->delete();
         return redirect()->back()
                         ->with('success','Governor deleted successfully');
     }
}
