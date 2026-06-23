<?php
namespace Modules\HumanResources\Traits;

use App\Models\Member;
use Modules\ProjectManagement\Entities\Cause;
use Modules\ProfileManagement\Entities\Profile;
use Modules\HumanResources\Entities\Beneficiary;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Carbon\carbon;
use Session;

trait BeneficiaryTrait {
use ProfileTrait;

    public function saveBeneficiary($cause=null)
    {
        if(!isset($cause)){
            $cause = Cause::findOrFail(!empty($this->data['cause_id']) ? $this->data['cause_id'] : $this->cause_id);   
        } 
        $beneficiary = new Beneficiary;                    
        $beneficiary->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->makeProfile()->id;           
        $beneficiary->city_id = !empty($this->data['city_id']) ? $this->data['city_id'] : $this->makeCity()->id;           
        $beneficiary->cause_id = $this->data['cause_id'];
        $beneficiary->telephone = $this->data['telephone'];     
        $beneficiary->remarks = $this->data['remarks'];     
        $beneficiary->email = !empty($this->data['email']) ? $this->data['email'] : NULL;     
        if ( !$cause->beneficiaries()->save($beneficiary)) {
            return redirect()->back()->withInput()->withErrors('Something went wrong with beneficiary creation');
        }
        return $beneficiary;
    }    
}
