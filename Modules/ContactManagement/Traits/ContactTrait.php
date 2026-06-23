<?php

namespace Modules\ContactManagement\Traits;

use Modules\ContactManagement\Entities\Contact;
use Modules\ContactManagement\Entities\Telephone;
use Modules\ContactManagement\Entities\SalesCycle;
use Modules\ContactManagement\Entities\SalesAction;
use Modules\ContactManagement\Entities\Lead;
use Modules\ProfileManagement\Entities\Profile;
use Session;
use Carbon\carbon;
use Modules\ClientManagement\Traits\OrganizationTrait;

trait ContactTrait {
    use OrganizationTrait;
   

    public function saveContact()
    {
        $contact = new Contact;
        if(isset($this->data['legal_name']))
        {
            $contact->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->makeOrganization()->id;
        }
        $contact->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : NULL;
        $contact->first_name = !empty($this->data['first_name']) ? $this->data['first_name'] : $this->first_name;
        $contact->last_name = !empty($this->data['last_name']) ? $this->data['last_name'] : $this->last_name;
        $contact->email = !empty($this->data['email']) ? $this->data['email'] : NULL;
        $contact->telephone = $this->data['telephone'];

        if ( !$contact->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $contact;
    }

    public function saveSalesCycle()
    {
        $salescycle = new SalesCycle;       
        $salescycle->label = $this->data['label'];
        $salescycle->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $salescycle->enabled = !empty($this->data['enabled']) ? $this->data['enabled'] : true;
        $salescycle->sequence = !empty($this->data['sequence']) ? $this->data['sequence'] : NULL;

        if ( !$salescycle->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $salescycle;
    }

    public function saveSalesAction()
    {
        $salesaction = new SalesAction;       
        $salesaction->label = $this->data['label'];
        $salesaction->sales_cycle_id = $this->data['sales_cycle_id'];
        $salesaction->sequence = !empty($this->data['sequence']) ? $this->data['sequence'] : NULL;
        $salesaction->enabled = !empty($this->data['enabled']) ? $this->data['enabled'] : true;

        if ( !$salesaction->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $salesaction;
    }

    public function saveLead()
    {
        $lead = new Lead;       
        $lead->contact_id = !empty($this->data['contact_id']) ? $this->data['contact_id'] : $this->saveContact()->id;
        $lead->sales_cycle_id = $this->data['sales_cycle_id'];
        $lead->designation_id = $this->data['designation_id'];

        if ( !$lead->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $lead;
    }


    public function saveTelephone($profile = null)
    {
        if(is_null($profile))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile_id);
        }
        $telephone = new Telephone;
        if(Telephone::whereProfileId($profile->id)->exists())
        {
            $telephone->phone_tag = 'Other';
        }else{
            $telephone->phone_tag = 'Default';
        }       

        $dial_code = !empty($this->data['dial_code']) ? $this->data['dial_code'] : $profile->dial_code;
        $telephone->phone_number = $dial_code.substr(!empty($this->data['telephone']) ? $this->data['telephone'] : $this->telephone,-10);
        if ( !$profile->telephones()->save($telephone)) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong');
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
