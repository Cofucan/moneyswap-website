<?php
namespace Modules\ProfileManagement\Traits;

use Modules\ProfileManagement\Entities\Agent;
use Modules\ProfileManagement\Entities\Profile;
use Modules\ProfileManagement\Traits\ProfileTrait;

use Session;
use File;
use DB;
trait AgentTrait {
use ProfileTrait;


public function saveAgent()
{
    $agent = new Agent;
    $agent->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->saveProfile()->id;
    $agent->annual_income = !empty($this->data['annual_income']) ? $this->data['annual_income'] : NULL;
    $agent->currency_code = !empty($this->data['currency_code']) ? $this->data['currency_code'] : 'NGN';
    $agent->occupation = !empty($this->data['occupation']) ? $this->data['occupation'] : NULL;
    if (!$agent->save()) {
        return redirect()->back()->withInput()->withErrors('Something went wrong');
    }
    unset($profile);
    return $agent;
}
public function phonesearch($value)
{
    $this->value = $value;
    $this->phone = '234'.substr($value,-10);
    $agent = Agent::whereHas('Profile.Telephones', function($item){
        $item->where('phone_number', $this->phone)
             ->Orwhere('phone_number', $this->value);
    })->first();
    if($agent)
    {
        return $agent;
    }
}


}
