<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\HumanResources\Entities\Employment;
use Modules\LocationManagement\Entities\State;
use Modules\HumanResources\Traits\EmploymentTrait;
//use Illuminate\Http\Request;
use Session;
use Auth;
use Carbon\carbon;
use Modules\LocationManagement\Traits\AddressTrait;
use App\Http\Requests\EmploymentFormRequest;

class EmploymentController extends Controller
{
    use EmploymentTrait;
    public function __construct()
    {
        $this->middleware(['auth','verified']);

    }
    //use AddressTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employments = Employment::with('Organization', 'Designation')->get();
        return view('humanresources::employments.index', compact('employments'));
    }

    public function manage()
    {
        $employments = Employment::scheduled()->get();
        return view('humanresources::employments.manage', compact('employments'));
    }

    public function toggle(Employment $employment)
    {
        if ($employment->published == 1) {
            $employment->published = 0;
            $feedback = 'employment record Unpublished successfully';
        } else {
            $employment->published = 1;
            $feedback = 'Employment record Unpublished successfully';
        }
        if ( ! $employment->save()) {
            return redirect()->back()->with('error', 'Could not update employment');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Auth::user()->profile;
        $employments = $this->getprofileEmployments(Session::get('profile_id'));
        $states = State::all()->pluck("state_name", "id");
        $designations = $profile->Role->department->designations->pluck('job_role', 'id');
        $employmentTypes = $this->allEmploymentTypes();
        return view('humanresources::employments.create', compact('states', 'designations', 'employments', 'employmentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmploymentFormRequest $request)
    {
        //         dd($request->all());
        $this->data = $request->all();
        if ( ! $this->saveEmployment()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if($request->todo =='Continue')
        {
            return redirect()->route('educations.create')->with('success','Employment History Added Successfully.');
        }
        return redirect()->back()->with('success', 'Employment history updated successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function show(Employment $employment)
    {
        //
        return view('humanresources::employments.show', compact('employment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function edit(Employment $employment)
    {
        //
        return view('humanresources::employments.edit', compact('employment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function update(EmploymentFormRequest $request, Employment $employment)
    {
        //
        if( ! $employment->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Employment details Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employment  $employment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employment $employment)
    {
        //
        $employment->delete();
        return redirect()->back()
                        ->with('success','Employment profile deleted successfully');
    }
}
