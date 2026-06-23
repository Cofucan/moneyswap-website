<?php

namespace Modules\LocationManagement\Traits;

use Illuminate\Http\Request;

use Modules\LocationManagement\Entities\Address;
use Modules\ProfileManagement\Entities\Profile;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\LocationManagement\Entities\City;
use Modules\LocationManagement\Entities\Neighbourhood;
use Carbon\carbon;
use Session;

trait AddressTrait {

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function saveAddress()
    {
        $address = new Address;
        $address->neighbourhood_id = !empty($this->data['neighbourhood_id']) ? $this->data['neighbourhood_id'] : $this->makeNeighbourhood()->id;
        $address->building_no = $this->data['building_no'];
        $address->address_prefix = !empty($this->data['address_prefix']) ? $this->data['address_prefix'] : 'No';
        $address->street_name = $this->data['street_name'];
        if ( ! $address->save()) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again later');
        }

        return $address;
    }
    public function makeState()
    {
        $this->state = State::updateOrCreate(
            [
                'country_id' => !empty($this->data['country_id']) ? $this->data['country_id'] : $this->country_id,
                'state_name' => ucfirst(!empty($this->data['state_name']) ? $this->data['state_name'] : $this->state_name)
            ],
            [
                'about_state' => !empty($this->data['about_state']) ? $this->data['about_state'] : NULL,
                'state_code' => !empty($this->data['state_code']) ? $this->data['state_code'] : Null,
                'published' => !empty($this->data['published']) ? $this->data['published'] : '0'
            ]
        );
        return $this->state;
    }
    public function makeCity()
    {
       // $this->getPackageInfo();
        $this->city = City::updateOrCreate(
            [
                'state_id' => !empty($this->data['state_id']) ? $this->data['state_id'] : $this->makeState()->id,
                'city_name' => ucfirst(!empty($this->data['city_name']) ? $this->data['city_name'] : $this->city_name)
            ],
            [
                'about_city' => !empty($this->data['about_city']) ? $this->data['about_city'] : NULL,
                'city_code' => !empty($this->data['city_code']) ? $this->data['city_code'] : Null,
                'published' => !empty($this->data['published']) ? $this->data['published'] : '1'
            ]
        );
        return $this->city;
    }
    public function makeNeighbourhood()
    {
        $this->neighbourhood = neighbourhood::updateOrCreate(
            [
                'city_id' => !empty($this->data['city_id']) ? $this->data['city_id'] : $this->city->id,
                'neighbourhood_name' => ucfirst(!empty($this->data['neighbourhood_name']) ? $this->data['neighbourhood_name'] : $this->neighbourhood_name)
            ],
            [
                'about_neighbourhood' => !empty($this->data['about_neighbourhood']) ? $this->data['about_neighbourhood'] : NULL,
                'postal_code' => !empty($this->data['postal_code']) ? $this->data['postal_code'] : Null,
                'published' => !empty($this->data['published']) ? $this->data['published'] : '1'
            ]
        );
        return $this->neighbourhood;
    }

    public function makeAddress()
    {
        if($this->makeNeighbourhood())
        {
            return $this->saveAddress();
        }
    }
    public function getAddressDetails()
    {
        if(isset($this->data['address_id']) || isset($this->address_id)){
            $this->address = Address::findorFail(!empty($this->data['address_id']) ? $this->data['address_id'] : $this->address_id);
        }else{
            $this->address = Address::where('is_default', true)->first();
        }
        return $this->address;
    }





}
