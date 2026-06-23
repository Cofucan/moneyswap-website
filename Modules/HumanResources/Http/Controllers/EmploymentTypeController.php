<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\HumanResources\Entities\EmploymentType;
use Illuminate\Http\Request;
use Session;

class EmploymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $employmentTypes = EmploymentType::all();
        return view('humanresources::employmenttypes.index', compact('employmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('humanresources::employmenttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [

            'employment_type' => 'required',

        ]);
        $employmentType = new EmploymentType();
        $employmentType->employment_type = $request->employment_type;
        $employmentType->tag = $request->tag;
        $employmentType->description = $request->description;
        if ( ! $employmentType->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'employmentType Added successfully.');
       return redirect()->back()->with('success','Employment Type Added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmploymentType  $employmentType
     * @return \Illuminate\Http\Response
     */
    public function show(EmploymentType $employmentType)
    {
        //
        return view('humanresources::employmentTypes.show',compact('employmentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmploymentType  $employmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(EmploymentType $employmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmploymentType  $employmentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmploymentType $employmentType)
    {
        //

        $this->validate($request, [
            'employment_type' => 'required',
        ]);
        if ( ! $employmentType->update($request->all())) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

       return redirect()->back()->with('success','Employment Type Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmploymentType  $employmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmploymentType $employmenttype)
    {
        //
        $employmenttype->delete();
        return redirect()->back()->with('success','Employment Type deleted successfully');
    }
}
