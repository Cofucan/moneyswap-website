<?php

namespace Modules\ContactManagement\Traits;

use Modules\ContactManagement\Entities\Telephone;
use Modules\ContactManagement\Entities\Contact;
use Modules\ProfileManagement\Entities\Profile;
use Modules\ClientManagement\Entities\Organization;
use Modules\SchoolManagement\Entities\Outlet;
use Modules\ClientManagement\Entities\Merchant;
use Session;
use Carbon\carbon;

trait TelephoneTrait {


    public function phoneTags(){
        $phoneTags = [
            'Work' => 'Work',
            'Default' => 'Default',
            'Home' => 'Home',
            'Other' => 'Other',
        ];
        return $phoneTags;
    }

    public function savePhone($profile = null)
    {
        if(is_null($profile))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] :$this->profile_id);
        }

        $dialling_code = !empty($this->data['dialling_code']) ? $this->data['dialling_code'] : '234';
        $phones = '';
        $phones = explode(',', $this->data['telephone']);
        foreach($phones as $phone) {
            //$phone = trim($phone);
            $tel = new Telephone;
            //$tel->phone_number = $dialling_code.substr($phones['0'],-10);
            $tel->phone_number = $dialling_code.substr($phone,-10);
            $tel->phone_tag = !empty($this->data['phone_tag']) ? $this->data['phone_tag'] : 'Default';
            if($profile->telephones()->save($tel)){
                //log
            }else{
                //log errors
            }
        }
        if(isset($errors))
        {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again');
        }
        return redirect()->back()->withInput()->withErrors('success', 'Telephone contacts added successfully');

    }

    public function saveTelephone()
    {

        $telephone = new Telephone;

        $country_code = !empty($this->data['country_code']) ? $this->data['country_code'] : '234';
        $telephone->phone_number = $country_code.substr(!empty($this->data['telephone']) ? $this->data['telephone'] : $this->telephone,-10);
        $telephone->phone_tag = !empty($this->data['phone_tag']) ? $this->data['phone_tag'] : 'Default';
        $telephone->phoneable_type = !empty($this->data['phoneable_type']) ? $this->data['phoneable_type'] : NULL;
        switch ($telephone->phoneable_type){
            case "profile":
                if(!isset($this->profile))
                {
                    $this->profile = Profile::find(!empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->phoneable_id);
                }
                return $this->profile->Telephones()->save($telephone);
            break;
            case "organization":
                if(!isset($this->organization))
                {
                    $this->organization = Organization::find(!empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->phoneable_id);
                }
                return $this->organization->Telephones()->save($telephone);
            break;
            case "outlet":
                if(!isset($this->outlet))
                {
                    $this->outlet = Outlet::find(!empty($this->data['outlet_id']) ? $this->data['outlet_id'] : $this->phoneable_id);
                }
                return $this->outlet->Telephones()->save($telephone);
            break;
            case "portal":
                if(!isset($this->portal))
                {
                    $this->portal = Portal::find(!empty($this->data['portal_id']) ? $this->data['portal_id'] : $this->phoneable_id);
                }
                return $this->portal->Telephones()->save($telephone);
            break;
            case "contact":
                if(!isset($this->contact))
                {
                    $this->contact = Contact::find(!empty($this->data['contact_id']) ? $this->data['contact_id'] : $this->phoneable_id);
                }
                return $this->contact->Telephones()->save($telephone);
            break;
            case "merchant":
                if(!isset($this->merchant))
                {
                    $this->merchant = Merchant::find(!empty($this->data['merchant_id']) ? $this->data['merchant_id'] : $this->phoneable_id);
                }
                return $this->merchant->Telephones()->save($telephone);
            break;
            case "sponsor":
                if(!isset($this->sponsor))
                {
                    $this->sponsor = Agent::find(!empty($this->data['agent_id']) ? $this->data['agent_id'] : $this->phoneable_id);
                }
                return $this->sponsor->Telephones()->save($telephone);
            break;
            default:
            $telephone->save();
        }
        return $telephone;
    }




    public function addTelephone($profile)
    {
        if(!empty($this->data['telephone']) || !empty($this->telephone))
        {
            return $this->saveTelephone($profile);
        }


    }

}
