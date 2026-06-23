<?php

namespace Modules\MemberManagement\Traits;

use Illuminate\Http\Request;
use Modules\RegistrationManagement\Entities\Registration;
use Modules\MemberManagement\Entities\Member;
use Modules\MemberManagement\Entities\MemberGrade;
use Modules\MemberManagement\Entities\MemberDocument;
use Modules\MemberManagement\Entities\MemberSchedule;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Modules\LocationManagement\Traits\AddressTrait;
use File;
use Auth;
use DB;
use Session;
use Carbon\carbon;

trait MemberTrait {
    use ProfileTrait;
    use AddressTrait;
    public function memberstats()
    {
    return DB::table('members')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'Scheduled' then 1 end) as Scheduled")
    ->selectRaw("count(case when status = 'Offered' then 1 end) as Offered")
    ->selectRaw("count(case when status = 'Accepted' then 1 end) as Accepted")
    ->selectRaw("count(case when status = 'Approved' then 1 end) as Approved")
    ->first();
    }
    public function saveMember($registration = null)
    {
        if((is_null($registration)) && (isset($this->data['registration_id']) || isset($this->registration_id)))
        {
            $registration_id = !empty($this->data['registration_id']) ? $this->data['registration_id'] : $this->registration_id;
            $registration = Registration::findOrFail($registration_id);
        }
        $member = new Member;
        $member->registration_id = !empty($registration->id) ? $registration->id : NULL;
        $member->agent_id = !empty($this->data['agent_id']) ? $this->data['agent_id'] : $registration->agent_id;
        $member->relationship_id = !empty($this->data['relationship_id']) ? $this->data['relationship_id'] : NULL;
        $member->academic_term_id = !empty($this->data['academic_term_id']) ? $this->data['academic_term_id'] : $registration->academic_term_id;
        $member->profile_id = !empty($registration->profile_id) ? $registration->profile_id : $this->saveProfile()->id;
        //$member->birth_sequence = !empty($this->data['birth_sequence']) ? $this->data['birth_sequence'] : $registration->birth_sequence;
        $member->campus_id = !empty($this->data['campus_id']) ? $this->data['campus_id'] : $registration->campus_id;
        $member->client_category_id = !empty($this->data['client_category_id']) ? $this->data['client_category_id'] : $registration->client_category_id;
        $member->grade_id = !empty($this->data['grade_id']) ? $this->data['grade_id'] : $registration->grade_id;
        $member->stream_id = !empty($this->data['stream_id']) ? $this->data['stream_id'] : $registration->stream_id;
        $member->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        $member->reside_with_family = !empty($this->data['reside_with_family']) ? $this->data['reside_with_family'] : NULL;
        if (!$member->save()) {
            return redirect()->back()->withErrors('Error generating member offer');
        }
        return $member;
    }




public function generateScheduleLabel()
{
    return $this->academicterm->academic_term. " " ."Member";
}


public function saveRequirement()
{
        $this->requirement->label =  !empty($this->data['label']) ? $this->data['label'] :Null;
        $this->requirement->overview =  $this->data['overview'];
        return $this->requirement;

}




}
