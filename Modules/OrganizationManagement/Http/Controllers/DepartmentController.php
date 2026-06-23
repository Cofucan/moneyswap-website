<?php

namespace Modules\OrganizationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\OrganizationManagement\Entities\Department;
use App\Models\Role;
use Modules\ProfileManagement\Entities\Profile;
use Modules\EmploymentManagement\Entities\Employee;
use Illuminate\Http\Request;
use DB;
use Session;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->types = [
            'Academic' => 'Academic',
            'Non-Academic' => 'Non-Academic',
            // 'Suspended' => 'Suspended',
        ];
    }
    public function saveDepartment()
    {

        $this->department = new Department;
        $this->department->label = $this->data['label'];
        $this->department->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $this->department->published = !empty($this->data['published']) ? $this->data['published'] : '1';
        // if(!is_null($this->data['hod_employee_id']))
        // {
        //     $this->department->hod_employee_id = $this->data['hod_employee_id'];
        // }


        if ( ! $this->department->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->department;
    }

    public function profiles(Request $request)
    {
        $department = $request->department;
        $profiles = Profile::where('department_id', $department)->pluck("role_name","id");
        return response()->json($profiles);
    }

    public function getroles(Request $request)
    {
        $department = $request->department;
        $roles = Role::where('department_id', $department)->pluck("role_name","id");
        return response()->json($roles);
    }

    public function manage()
    {
        //
        $departments = Department::get();
        return view ('organizationmanagement::departments.manage', compact('departments'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::get();
        return view ('organizationmanagement::departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = Department::pluck('label', 'id');
        return view('organizationmanagement::departments.create', compact('departments', 'types'));
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
            'label' => 'required'
        ]);

        $this->data = $request->all();
        if($this->saveDepartment())
        {
            return redirect()->route('departments.show', $this->department->id)->with('success','Department Added successfully.');
        }
    }

    public function toggle(Department $department)
    {
        if ($department->published == 1) {
            $department->published = 0;
            $feedback = 'Department Unpublished successfully';
        } else {
            $department->published = 1;
            $feedback = 'Department Published successfully';
        }
        if ( ! $department->save()) {
            return redirect()->back()->with('error', 'Could not update Department');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
        return view('organizationmanagement::departments.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        $types = $this->types;
        $parents = Department::all()->pluck('label', 'id');
        return view('organizationmanagement::departments.edit',compact('department', 'parents', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
        $this->validate($request, [
            'label' => 'required'
        ]);
        if( !$department->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
        $department->delete();
         return redirect()->back()
                         ->with('success','Department deleted successfully');
    }
}
