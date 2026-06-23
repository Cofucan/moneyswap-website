<?php

namespace Modules\ProfileManagement\Traits;

use Illuminate\Http\Request;
use Modules\RegistrationManagement\Entities\Registration;
use Modules\MemberManagement\Entities\Member;
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
      
        $member = new Member;
        $member->registration_id = !empty($registration->id) ? $registration->id : NULL;
        $member->profile_id = !empty($registration->profile_id) ? $registration->profile_id : $this->saveProfile()->id;
        //$member->birth_sequence = !empty($this->data['birth_sequence']) ? $this->data['birth_sequence'] : $registration->birth_sequence;
       
        $member->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        if (!$member->save()) {
            return redirect()->back()->withErrors('Error generating member offer');
        }
        return $member;
    }



public function saveRequirement()
{
        $this->requirement->label =  !empty($this->data['label']) ? $this->data['label'] :Null;
        $this->requirement->overview =  $this->data['overview'];
        if (!$this->requirement->save()) {
            return redirect()->back()->withInput()->withErrors('Something went wrong');
        }
        return $this->requirement;

}

public function saveMemberDocument()
{
    return MemberDocument::firstOrCreate(
        [
            'document_type_id' => !empty($this->data['document_type_id']) ? $this->data['document_type_id'] : $this->document_type_id,
            'member_grade_id' => !empty($this->data['member_grade_id']) ? $this->data['member_grade_id'] : $this->member_grade_id
        ],
        [
            'validate' => !empty($this->data['validate']) ? $this->data['validate'] : '1'
        ]
    );

}


}
