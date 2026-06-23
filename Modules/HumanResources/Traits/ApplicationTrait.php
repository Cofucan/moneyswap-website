<?php

namespace Modules\HumanResources\Traits;

use Illuminate\Http\Request;

use Modules\HumanResources\Entities\Application;

use Auth;
use File;
use Session;
use DB;

trait ApplicationTrait {

    public function saveApplication()
    {
        if(isset($this->data['application_id']) || isset($this->application_id)){           
            $this->application = Application::findorFail(!empty($this->data['application_id']) ? $this->data['application_id'] : $this->application_id);           
        }else{          
            $this->application = new Application;   
            $this->application->vacancy_id = $this->data['vacancy_id'];
            $this->application->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : Session::get('profile_id');
        } 
        $this->application->cover_letter = !empty($this->data['cover_letter']) ? $this->data['cover_letter'] :''; 
       
        $this->application->status = !empty($this->data['status']) ? $this->data['status'] :'Wish';       
        if ( ! $this->application->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->application;
    }

   
    public function ApplicationProcessor()
    {
       if(!isset($this->application))
        {
            $this->application = Application::findorFail(!empty($this->data['application_id']) ? $this->data['application_id'] : $this->application_id);
        }
        if($this->application->status == 'Cancelled')
        {
            return redirect()->back()->with('Error', 'status cannot be updated');
        }        
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;        
        $this->application->status= $status;
        switch ($status){
            case "Submitted":
                $this->application->application_date = Carbon::now();
                //$this->application->availability_date = Carbon::now();
            //send notification to applicant
            break;
            case "Rejected":            
            
            break;          

            }
            return $this->application->save();
    } 

   
}
