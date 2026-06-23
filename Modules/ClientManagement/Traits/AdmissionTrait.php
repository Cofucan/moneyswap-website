<?php

namespace Modules\AdmissionManagement\Traits;

use Illuminate\Http\Request;
use Modules\RegistrationManagement\Entities\Registration;
use Modules\AdmissionManagement\Entities\Admission;
use Modules\AdmissionManagement\Entities\AdmissionGrade;
use Modules\AdmissionManagement\Entities\AdmissionDocument;
use Modules\AdmissionManagement\Entities\AdmissionSchedule;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\ProfileManagement\Traits\SponsorTrait;
use Modules\LocationManagement\Traits\AddressTrait;
use Modules\ClientManagement\Traits\StudentTrait;
use File;
use Auth;
use DB;
use Session;
use Carbon\carbon;

trait AdmissionTrait {
    use StudentTrait;
    use SponsorTrait;
    use AddressTrait;
    public function admissionstats($academictermId = null)
    {
        $query = DB::table('admissions');
        if(!is_null($academictermId))
        {
            $query->where('academic_term_id', $academictermId);
        }
        return $query
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'Scheduled' then 1 end) as Scheduled")
        ->selectRaw("count(case when status = 'Offered' then 1 end) as Offered")
        ->selectRaw("count(case when status = 'Accepted' then 1 end) as Accepted")
        ->selectRaw("count(case when status = 'Approved' then 1 end) as Approved")
        ->first();
    }

    public function saveAdmission($registration = null)
    {
        if((is_null($registration)) && (isset($this->data['registration_id']) || isset($this->registration_id)))
        {
            $registration_id = !empty($this->data['registration_id']) ? $this->data['registration_id'] : $this->registration_id;
            $registration = Registration::findOrFail($registration_id);
            $this->data['birth_sequence'] = $registration->birth_sequence;
            $this->data['reside_with_family']= $registration->reside_with_family;
            //$this->data['reside_with_family']= $registration->reside_with_family;
        }else{
            $this->data['first_name'] = !empty($this->data['student_firstname']) ? $this->data['student_firstname'] :$this->first_name ;
            $this->data['last_name'] = !empty($this->data['student_lastname']) ? $this->data['student_lastname'] :$this->last_name ;
            $this->data['middle_name'] = !empty($this->data['student_middlename']) ? $this->data['student_middlename'] :NULL;
            $profile = $this->makeProfile();
        }
        $this->data['role_id'] = 9;
        $admission = new Admission;
        $admission->registration_id = !empty($registration->id) ? $registration->id : NULL;
        $admission->agent_id = !empty($this->data['agent_id']) ? $this->data['agent_id'] : $registration->agent_id;
        $admission->relationship_id = !empty($this->data['relationship_id']) ? $this->data['relationship_id'] : NULL;
        $admission->academic_term_id = !empty($this->data['academic_term_id']) ? $this->data['academic_term_id'] : $registration->academic_term_id;
        $admission->profile_id = !empty($registration->profile_id) ? $registration->profile_id : $profile->id;
        $admission->birth_sequence = !empty($this->data['birth_sequence']) ? $this->data['birth_sequence'] : NULL;
        $admission->outlet_id = !empty($this->data['outlet_id']) ? $this->data['outlet_id'] : $registration->outlet_id;
        $admission->client_category_id = !empty($this->data['client_category_id']) ? $this->data['client_category_id'] : $registration->client_category_id;
        $admission->grade_id = !empty($this->data['grade_id']) ? $this->data['grade_id'] : $registration->grade_id;
        $admission->stream_id = !empty($this->data['stream_id']) ? $this->data['stream_id'] : $registration->stream_id;
        $admission->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        $admission->reside_with_family = !empty($this->data['reside_with_family']) ? $this->data['reside_with_family'] : NULL;
        if (!$admission->save()) {
            return redirect()->back()->withErrors('Error generating admission offer');
        }
        return $admission;
    }


    public function processAdmission($admission = null)
    {
        if(is_null($admission) && (isset($this->data['admission_id']) || isset($this->admission_id)))
        {
            $admission = Admission::findOrFail(!empty($this->data['admission_id']) ? $this->data['admission_id'] : $this->admission_id);
        }
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        if($admission->status == $status)
        {
            return redirect()->back()->with('Error', 'Invalid operation');
        }
        return DB::transaction ( function() use ($admission, $status){
        switch ($status){
            case "Offerred":
                $admission->offered_at = Carbon::now();
                $admission->entry_number = Admission::max('entry_number')+1;
                $admission->feedback_deadline = Carbon::today()->addMonth();
                //send offer letter to client
             break;
             case "Accepted":
                $admission->feedback_at = Carbon::now();
               //send notification to applicant
                $this->destination = 'admissions.index';
                break;

            case "Approved":
                if(is_null($admission->entry_number))
                {
                    $admission->entry_number = Admission::max('entry_number')+1;
                }
                $admission->approver_user_id = Auth::id();
                $admission->approved_at = Carbon::now();
                $this->saveStudent($admission);
            break;

            }
            $admission->status= $status;
            if($admission->save()){
              //  $this->registration->save();
                return $admission;

            }
        });
    }

}
