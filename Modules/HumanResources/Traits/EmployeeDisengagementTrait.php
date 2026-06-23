<?php

namespace Modules\HumanResources\Traits;

use Illuminate\Http\Request;
use App\Models\User;
//use Modules\ClientManagement\Entities\Outlet;
use Modules\ProfileManagement\Entities\Profile;
use Modules\HumanResources\Entities\Employee;
use Modules\HumanResources\Entities\EmployeeDisengagement;
//use Modules\ProfileManagement\Entities\Person;
use Session;
use File;
use DB;
use Carbon\carbon;

trait EmployeeDisengagementTrait {



    public function processEmployeeDisengagement()
    {
        if(!isset($employee))
        {
            $employee = Employee::findorFail(!empty($this->data['employee_id']) ? $this->data['employee_id'] : $this->employee_id);
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
                    $employee->availability = false;
                }
            break;

            }
            $employee->status= $status;
            if($employee->save()){
                return $this->destination;
            }
    }

    public function DisengageEmployee($employee = null)
    {
        if(is_null($employee))
        {
            $employee = Employee::findorFail(!empty($this->data['employee_id']) ? $this->data['employee_id'] : $this->employee_id);
        }
        $this->employeedisengagement = new EmployeeDisengagement;
        $this->employeedisengagement->left_at = !empty($this->data['left_at']) ? $this->data['left_at'] :Carbon::today();
        $this->employeedisengagement->modality = !empty($this->data['modality']) ? $this->data['modality'] : 'Absconded';
        $this->employeedisengagement->reason = !empty($this->data['reason']) ? $this->data['reason'] : NULL;
        if(!$employee->employeedisengagement()->save($this->employeedisengagement))
        {
            return redirect()->back()->with('error','Something went wrong');
        }
        $employee->availability = false;
        $employee->status = 'Left';
        $employee->Profile->status = 'Inactive';
        if (User::where('profile_id',$employee->profile_id)->exists()) {
            $employee->Profile->User->active = false;
        }        
        if($employee->push()){
            return redirect()->back()->with('success','Employee profile updated successfully');
        }
        }


}
