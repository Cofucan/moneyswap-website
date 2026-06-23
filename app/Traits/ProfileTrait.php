<?php
namespace App\Traits;
use App\Models\Profile;
use App\Models\User;
use App\Models\Role;
use App\Traits\OrganizationTrait;
use App\Models\Telephone;

use App\Traits\WalletTrait;
use App\Traits\AddressTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

trait ProfileTrait {
use OrganizationTrait;
use WalletTrait;
use AddressTrait;

public function profilestats()
{
    return DB::table('profiles')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'Moderating' then 1 end) as moderating")
    ->selectRaw("count(case when status = 'Approved' then 1 end) as approved")
    ->selectRaw("count(case when status = 'Accepted' then 1 end) as accepted")
    ->selectRaw("count(case when status = 'Closed' then 1 end) as closed")
    ->first();
}

public function makeProfile()
{
    try{        
        if($this->saveProfile())
        {
            return $this->addUser();
        }

    } catch (\Exception $ex)
    {
        throw $ex;
    }

}


public function saveProfile()
    {
        try{
           // DB::transaction(function(){
                $this->profile = new Profile;
                if(isset($this->data['legal_name']))
                {
                    $this->data['organization_id'] = $this->makeOrganization()->id;
                }
                $this->profile->first_name = $this->data['first_name'] ;
                $this->profile->last_name = $this->data['last_name'] ;
                $this->profile->middle_name = !empty($this->data['middle_name']) ? $this->data['middle_name'] : NULL;
                $this->profile->salutation = !empty($this->data['salutation']) ? $this->data['salutation'] : NULL;
                $this->profile->gender = !empty($this->data['gender']) ? $this->data['gender'] : NULL;
                $this->profile->country_id = !empty($this->data['country_id']) ? $this->data['country_id'] : 1;
                // $this->profile->bio = !empty($this->data['bio']) ? $this->data['bio'] : NULL;
                $this->profile->birthday = !empty($this->data['birthday']) ? $this->data['birthday'] : NULL;
                $this->profile->referral_code = !empty($this->data['referral_code']) ? $this->data['referral_code'] : $this->makeReferralCode();
                $this->profile->email = !empty($this->data['email']) ? $this->data['email'] : NULL;
                $this->profile->role_id = !empty($this->data['role_id']) ? $this->data['role_id'] : $this->defaultRole()->id;
                $this->profile->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : NULL;
                if(isset($this->avatar))
                {
                    $this->savePassportPhoto() ;
                }
                dd($this->data);
                if($this->profile->save())
                {
                    if(isset($this->data['telephone']))
                    {
                        $country_code = !empty($this->data['country_code']) ? $this->data['country_code'] : $this->profile->dial_code;
                        Telephone::create([
                            'profile_id' => $this->profile->id,
                            'phone_number' => $country_code.substr(!empty($this->data['telephone']) ? $this->data['telephone'] : $this->telephone,-10),
                        ]);
                    }
                   return $this->profile;
                }

           // });

        } catch (\Exception $ex)
        {
            $this->profile_message = 'Something went wrong' . $ex->getMessage();
        }
    }

    public function addUser($profileId)
    {
        $profile = Profile::findOrFail($profileId);
        $this->user = new User;
        $this->user->email = !empty($this->data['email']) ? $this->data['email'] : $this->profile->email;
        $this->user->password = Hash::make(!empty($this->data['password']) ? $this->data['password'] : trim($this->profile->Person->last_name));
        $this->user->change_password = !empty($this->data['change_password']) ? $this->data['change_password'] : false;
        $this->user->profile_id = $profile->id;
        $this->user->is_active = !empty($this->data['is_active']) ? $this->data['is_active'] : false;
        if ( $this->user->save())
        {
            return $this->user;
        }

    }

public function defaultRole()
{
    return Role::default();
}
public function makeReferralCode()
{
    $referral_code = $this->generateReferralCode();
    if(Profile::where('referral_code', $referral_code)->exists())
    {
        return $this->makeReferralCode();
    }
    return $referral_code;
}


public function generateReferralCode()
{
    return trim($this->profile->first_name).rand(1111,9999);
}

public function ProfileProcessor()
{
    if(!isset($this->profile)){
        $this->profile = Profile::findorFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile_id);
    }
    $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
    switch ($status){
        case "Moderating":
        //$this->destination = 'vacancies.show';
        // return redirect()->route('vacancies.package');
        break;
        case "Approved":

            if($this->saveWallet())
            {
               // Mail::to($this->profile->email)->send(new ProfileApproval($this->profile));
            }

        //notify the organization of approval
        break;
        case "Banned":
        //if package is greater than 1 generate and set redirect destination to invoice
            //notify the buyer
        break;
        case "Deactivate":
            //notify the buyer
        break;

        }
        $this->profile->status = $status;
        if($this->profile->save()){
            return $this->profile;
        }
}


}
