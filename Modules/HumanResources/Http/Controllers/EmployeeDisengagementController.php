<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\EmployeeDisengagement;
use Illuminate\Http\Request;
use Modules\HumanResources\Traits\EmployeeDisengagementTrait;

class EmployeeDisengagementController extends Controller
{
    use EmployeeDisengagementTrait;

    public function process(Request $request)
    {
        $this->validate($request, [
           'employee_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        if($this->processEmployee())        {
            return redirect()->back()->with('success','Action performed successfully.');
        }
    }
    public function manage()
    {
        //$counter = $this->employeeStats();
        $employeedisengagements = EmployeeDisengagement::with('Employee', 'Employee.Profile')->all();
        return view('humanresources::employeedisengagements.manage', compact('employeedisengagements', 'formerstaff'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'employee_id' => 'required',
            'modality' => 'required',
            'reason' => 'required',
            'document_path.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('document_path')) {
            $this->document_path = $request->file('document_path');
        }
        if ( ! $this->DisengageEmployee()) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong');
        }
        return redirect()->back()->with('success','Employee disengagement record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeDisengagement  $employeeDisengagement
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeDisengagement $employeedisengagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeDisengagement  $employeeDisengagement
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeDisengagement $employeedisengagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeDisengagement  $employeeDisengagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeDisengagement $employeedisengagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeDisengagement  $employeeDisengagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDisengagement $employeedisengagement)
    {
        //
        $employeedisengagement->delete();
         return redirect()->back()
                         ->with('success','Employee deleted successfully');
    }
}
