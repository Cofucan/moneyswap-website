<?php

namespace Modules\HumanResources\Traits;

use Illuminate\Http\Request;
//use App\Models\Designation;
use Modules\ContentManagement\Entities\Page;
use Modules\HumanResources\Entities\Employee;
use Modules\HumanResources\Entities\EmployeeDisengagement;
use Session;
use File;
use DB;
use Carbon\carbon;
use Modules\ProfileManagement\Traits\UserSetupTrait;

trait EmployeeTrait {
    use UserSetupTrait;

    public function saveEmployee()
    {
        $employee = new Employee;
        $employee->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->saveProfile()->id;
        $employee->id_number = !empty($this->data['id_number']) ? $this->data['id_number'] : Employee::max('id_number')+1 ;
        $employee->hired_at = !empty($this->data['hired_at']) ? $this->data['hired_at'] : Carbon::today() ;
        $employee->employment_type_id = $this->data['employment_type_id'];
        $employee->designation_id = $this->data['designation_id'];
        $employee->marital_status = $this->data['marital_status'];
        $employee->application_id = !empty($this->data['application_id']) ? $this->data['application_id'] : NULL;
        $employee->availability = !empty($this->data['availability']) ? $this->data['availability'] : true;
        $employee->campus_id = !empty($this->data['campus_id']) ? $this->data['campus_id'] : NULL;
        if ( ! $employee->save()) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong');
        }
        if(isset($this->data['setup']) && ($this->data['setup'] == '1' || $this->data['setup'] == true)){
            $this->makeUser($employee->profile);
        }
        return $employee;
    }
    //

    public function employee($slug)
    {
        $employee = Employee::with('Designation', 'EmployeeType', 'Qualification')->where('slug', $slug)->firstOrFail();
        return view('humanresources::employees.employee', compact('employee'));
    }


    public function academics()
    {
        $page_tag = 'staff-directory';
        $page = Page::where('page_tag', $page_tag)->first();
        $employees = Employee::educators()->paginate(8);
        return view ('humanresources::employees.stafflist', compact('employees', 'page'));
    }

    public function processEmployee()
    {
        if(!isset($this->employee))
        {
            $this->employee = Employee::findorFail(!empty($this->data['employee_id']) ? $this->data['employee_id'] : $this->employee_id);
        }
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;

        switch ($status){
            case "Probation":

            break;
            case "Approved":

                break;
            case "Confirmed":

            break;

            case "Leave":
            break;

            case "Left":
                if($this->DisengageEmployee())
                {
                    $this->employee->availability = false;
                }
            break;

            }
            $this->employee->status= $status;
            if($this->employee->save()){
                return $this->destination;
            }
    }

    


    public function employeeStats()
    {
        return DB::table('employees')
                    ->selectRaw('count(*) as total')
                    ->selectRaw("count(case when status = 'Probation' then 1 end) as probation")
                    ->selectRaw("count(case when status = 'Confirmed' then 1 end) as confirmed")
                    ->selectRaw("count(case when status = 'Sabatical' then 1 end) as leave")
                    ->selectRaw("count(case when status = 'Left' then 1 end) as left")
                    //->selectRaw("count(case when status = 'Enrolled' then 1 end) as enrolled")
                    ->first();
    }

}
