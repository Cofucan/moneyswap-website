<?php
namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\Employee;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\HumanResources\Entities\EmploymentType;
use Modules\ContentManagement\Entities\Page;
use Modules\HumanResources\Entities\Qualification;
use Modules\HumanResources\Traits\EmployeeTrait;
use Modules\HumanResources\Entities\Designation;
use Illuminate\Http\Request;
use Modules\HumanResources\Exports\EmployeesExport;
use Modules\HumanResources\Imports\EmployeesImport;
use Session;
use Excel;
use File;
use Image;

class EmployeeController extends Controller
{
    use EmployeeTrait;
    public function __construct(Employee $employee)
    {
        // $this->middleware(['auth','verified']);
    }

    public function upload()
    {
       return view('humanresources::employees.upload');
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function import()
    {
       // (new UsersImport)->import('users.xlsx', 'local', \Maatwebsite\Excel\Excel::XLSX);
        Excel::import(new EmployeesImport, request()->file('file'));
        return redirect()->back()->with('success', 'Data imported successfully');
    }

    /**
     * View PDF on the browser
     * @return pdf [description]
     */

    public function manage()
    {
        //$counter = $this->employeeStats();
        $employees = Employee::active()->get();
        return view('humanresources::employees.manage', compact('employees'));
    }

    public function past()
    {
        $employees = Employee::former()->get();
        return view('humanresources::employees.past', compact('employees'));
    }

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


    public function status($status)
    {
        $employees = Employee::bystatus($status)->get();
        return view('humanresources::employees.list', compact('employees', 'status'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::active()->paginate(12);
        return view('humanresources::employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employmentTypes= EmploymentType::all()->pluck("label", "id");
        $designations= Designation::active()->pluck("job_role", "id");
        return view('humanresources::employees.create', compact('employmentTypes', 'designations'));
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
        $employee = $this->saveEmployee();
        if ( !$employee) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, please try later');
        }
        return redirect()->route('employees.show', $employee)->with('success','Employee Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
     public function show(Employee $employee)
     {
        $countries = Country::all()->pluck("citizen_title", "country_code");
        // $designations = $employee->profile->Role->department->designations->pluck('job_role', 'id');
        $designations = Designation::active()->pluck('job_role', 'id');
        $employmentTypes = EmploymentType::active()->get();
        $states = State::all()->plucK("state_name", "id");
        return view('humanresources::employees.show',compact('employee', 'countries', 'states','designations', 'employmentTypes'));
     }


     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Employee  $employee
      * @return \Illuminate\Http\Response
      */
     public function edit(Employee $employee)
     {
        $employmentTypes= EmploymentType::all()->pluck("label", "id");
        $designations= Designation::active()->pluck("job_role", "id");

        $employmentStatus = [
            'Probation' => 'Probation',
            'Confirmed'  => 'Confirmed',
            'Retired'  => 'Retired',
            'Resigned' => 'Resigned'
        ];
        return view('humanresources::employees.edit',compact('employee', 'employmentTypes', 'designations', 'employmentStatus'));
     }


     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Employee  $Employee
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Employee $employee)
     {
        // dd($request->all());
        $this->validate($request, [
            'designation_id' => 'required',
            'employment_type_id' => 'required',
            'hired_at' => 'required',
            'passport_photograph.*' => 'image|mimes:jpeg,jpg,png,gif|max:2000'
        ]);
        if ( ! $employee->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try later');
        }
        return redirect()->route('employees.show', $employee)->with('success','Employee Updated successfully.');
     }
     public function preview(Employee $employee)
    {
       return view('humanresources::employees.employee',compact('employee'));
    }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Employee  $employee
      * @return \Illuminate\Http\Response
      */
     public function destroy(Employee $employee)
     {
         if($employee->allocations->count() > 0)
         {
            return redirect()->back()
            ->with('error','Please delete all associated resources before removing employee. Cannot Delete Employee Record');
         }
        $employee->delete();
         return redirect()->back()
                         ->with('success','Employee deleted successfully');
     }
}
