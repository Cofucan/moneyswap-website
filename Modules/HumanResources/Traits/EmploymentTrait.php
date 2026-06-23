<?php

namespace  Modules\HumanResources\Traits;

use Illuminate\Http\Request;
use Modules\ClientManagement\Entities\Department;
use Modules\HumanResources\Entities\EmploymentType;
use Modules\HumanResources\Entities\Employment;
use Session;
use Carbon\carbon;
use Modules\ClientManagement\Traits\OrganizationTrait;
use Modules\LocationManagement\Traits\AddressTrait;
use Modules\ClientManagement\Traits\DepartmentTrait;

trait EmploymentTrait {
    use OrganizationTrait;
    use DepartmentTrait;
    use AddressTrait;


    public function saveEmployment()
    {
        $this->employment = new Employment;
        $this->employment->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile->id;
        $this->employment->designation_id = !empty($this->data['designation_id']) ? $this->data['designation_id'] : $this->makeDesignation()->id ;
        $this->employment->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->makeOrganization()->id ;
        $this->employment->currency = !empty($this->data['currency']) ? $this->data['currency'] : 'NGN';
        $this->employment->neighbourhood_id = !empty($this->data['neighbourhood_id']) ? $this->data['neighbourhood_id'] : $this->makeNeighbourhood()->id ;
        $this->employment->employment_type_id = $this->data['employment_type_id'];
        $this->employment->salary = (float) str_replace(',', '', !empty($this->data['salary']) ? $this->data['salary'] : $this->salary);
        $this->employment->accomplishments = !empty($this->data['accomplishments']) ? $this->data['accomplishments'] : NULL;
        $this->employment->started_at = $this->data['started_at'];
        $this->employment->disengaged_at = !empty($this->data['disengaged_at']) ? $this->data['disengaged_at'] : NULL;
        if ( ! $this->employment->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->employment;
    }


    public function getprofileEmployments($profile_id)
    {
        return Employment::with('Organization', 'Designation')->whereProfileId($profile_id)->get();
    }

    public function PaymentCycles()
    {
        return [
            'Monthly' => 'Monthly',
            'Weekly' => 'Weekly',
            'Annually' => 'Annually',
        ];
    }


    public function allEmploymentTypes()
    {
        return EmploymentType::all();
    }



}
