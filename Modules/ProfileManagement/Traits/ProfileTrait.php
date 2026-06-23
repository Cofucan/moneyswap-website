<?php
namespace Modules\ProfileManagement\Traits;

use Modules\ProfileManagement\Entities\Profile;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\RoleManagement\Entities\Role;
use Modules\HumanResources\Entities\Designation;
use Modules\ProfileManagement\Entities\Salutation;
use Modules\ContactManagement\Traits\TelephoneTrait;
use Modules\LocationManagement\Traits\AddressTrait;
use Modules\OrganizationManagement\Traits\OrganizationTrait;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\carbon;
use Session;
use Image;
use File;
use DB;
use Mail;
trait ProfileTrait {
use OrganizationTrait, TelephoneTrait, AddressTrait;

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

public function makeUser($profile = null)
    {

    }

    public function addUser($profile = null)
    {
        if(is_null($profile))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile_id);
        }
        $user = new User;
        $user->email = !empty($this->data['email']) ? $this->data['email'] : $profile->email;
        $user->password = Hash::make(!empty($this->data['password']) ? $this->data['password'] : $profile->default_password);
        $user->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $profile->id;
        $user->change_password = !empty($this->data['change_password']) ? $this->data['change_password'] : false;
        $user->enabled = false;
        if($user->save()){
            return $user;
        }
        return redirect()->back()->withInput()->withErrors('error', 'Cant create a user login');
    }
    public function makeProfile()
    {
        if(isset($this->data['profile_id']) || isset($this->profile_id))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] :$this->profile_id);
        }
        $profile = $this->saveProfile();
        if(isset($profile))
        {
            return $this->addUser($profile);
        }
        return redirect()->back()->withInput()->withErrors('error', 'Cant create a profile for the specified user');
    }
    public function saveProfile()
    {
        if(isset($this->data['legal_name']))
        {
            $organization = $this->makeOrganization();
            $this->data['organization_id'] = $organization->id;
        }
        $profile = new Profile;
        $profile->role_id = !empty($this->data['role_id']) ? $this->data['role_id'] : 11;
        $profile->first_name = !empty($this->data['first_name']) ? $this->data['first_name'] : $this->first_name;
        $profile->last_name = !empty($this->data['last_name']) ? $this->data['last_name'] : $this->last_name;
        $profile->middle_name = !empty($this->data['middle_name']) ? $this->data['middle_name'] : NULL;
        $profile->salutation = !empty($this->data['salutation']) ? $this->data['salutation'] : NULL;
        $profile->gender = !empty($this->data['gender']) ? $this->data['gender'] : NULL;
        $profile->religion_id = !empty($this->data['religion_id']) ? $this->data['religion_id'] : NULL;
        $profile->primary_language = !empty($this->data['primary_language']) ? $this->data['primary_language'] : NULL;
        $profile->bio = !empty($this->data['bio']) ? $this->data['bio'] : NULL;
        $profile->birthplace = !empty($this->data['birthplace']) ? $this->data['birthplace'] : NULL;
        $profile->country_code = !empty($this->data['country_code']) ? $this->data['country_code'] : NULL;
        $profile->birthday = !empty($this->data['birthday']) ? $this->data['birthday'] : NULL;
        $profile->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : NULL;
        $profile->email = !empty($this->data['email']) ? $this->data['email'] : NULL;
        $profile->address_id = !empty($this->data['address_id']) ? $this->data['address_id'] : NULL;
        if(isset($this->avatar))
        {
            $this->savePassportPhoto($profile) ;
        }
        if($profile->save())
        {
            if(isset($this->data['telephone']))
            {
                $this->savePhone($profile);
            }

        return $profile;
        }
        return redirect()->back()->withInput()->withErrors('error', 'Cant create a profile for the specified user');
    }


    public function saveProfileAddress($profile = null)
    {
        if(is_null($profile))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] :$this->profile_id);
        }
        $profileaddress = new ProfileAddress;
        $profileaddress->address_id = !empty($this->data['address_id']) ? $this->data['address_id'] : $this->saveAddress()->id;
        $profileaddress->address_type = !empty($this->data['address_type']) ? $this->data['address_type'] : 'Home';
        $profileaddress->date_from = !empty($this->data['date_from']) ? $this->data['date_from'] : Carbon::today();
        $profileaddress->date_to = !empty($this->data['date_to']) ? $this->data['date_to'] : NULL;
        $profileaddress->enabled = !empty($this->data['enabled']) ? $this->data['enabled'] : true;
        if(!$profile->ProfileAddresses()->save($profileaddress))
        {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again');
        }
        return $profileaddress;

    }


   public function RetrieveDefaultRoleId()
    {
        if(isset($this->data['designation_id']) || isset($this->designation_id)){
            $designation = Designation::findOrFail(!empty($this->data['designation_id']) ? $this->data['designation_id'] : $this->designation_id);
            $this->role_id = $designation->Department->role_id;
        }elseif(isset($this->data['department_id'])){
            $department = Department::findOrFail($this->data['department_id']);
            $this->role_id = $department->role_id;
        }else{
            $role = Role::where('is_default', true)->first();
            $this->role_id = $role->id ;
        }
        return $this->role_id;
    }

    public function LinkAccount($profile)
    {
        if(is_null($profile))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile_id);
        }
        if(is_null($profile->account_id) && ($this->data['account_id'] || $this->account_id))
        {
            //create profile account
            $account = $this->saveAccount();
        }
        $profile->account_id = !empty($this->data['account_id']) ? $this->data['account_id'] : $account->id;
        return $profile->save();
    }

    public function getDefaultRoleId()
    {
        if(isset($this->data['designation_id']) || isset($this->designation_id)){
            $designation = Designation::findOrFail(!empty($this->data['designation_id']) ? $this->data['designation_id'] : $this->designation_id);
            return $designation->role_id;
        }elseif(isset($this->data['department_id']) || isset($this->department_id)){
            $profile_type = !empty($this->data['department_id']) ? $this->data['department_id'] : $this->department_id;
            $role = Role::where('department_id', $profile_type)->where('is_default', true)->first();
            return $role->id ;
        }
        return 5;
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




    public function getParentId()
    {

        if(isset($this->parent_code) || isset($this->data['parent_code']))
        {
            $parent = Profile::where('referral_code', !empty($this->data['parent_code']) ? $this->data['parent_code'] : $this->parent_code)->first();
            return $parent->id;
        }
        return NULL;
    }

    public function getDefaultRole()
    {
        return Role::where('is_default', true);
    }

    public function getSelfRegisterRoles()
    {
        return Role::whereSelfSignup(true)->first();
    }


    public function birthYears()
    {
        $birthYears = Profile::select(\DB::raw('YEAR(birth_date) as year, COUNT(id) as amount'))
                        ->groupBy(\DB::raw('YEAR(birth_date)'))
                        ->get();
        return $birthYears;
    }
    public function users()
    {
        $chart_options = [
            'chart_title' => 'Users by weeks',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        $users = User::with('Person')->get();
        return view ( 'people.registrations', compact('users', 'chart1'));
    }


    public function allSalutations()
    {
        return Salutation::all()->pluck("title");
    }
    public function savePassportPhoto($profile)
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/profiles/')) {
                $person_img = File::makeDirectory('images/profiles', 0777, true);
            }
            $filename = Str::slug($profile->name).'_'.time().'.'.$this->avatar->getClientOriginalExtension();
            $person_photo = 'images/profiles/' . $filename;
            $profile->avatar     = $person_photo;
            // upload image to server
            Image::make($this->avatar)->fit('389', '439', function ($constraint) {
                $constraint->upsize();
            })->save($person_photo);

    }
}
