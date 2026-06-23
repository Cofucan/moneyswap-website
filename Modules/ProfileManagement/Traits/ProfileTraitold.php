<?php
namespace Modules\ProfileManagement\Traits;

use Modules\ProfileManagement\Entities\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\RoleManagement\Entities\Role;
use Modules\MembershipManagement\Entities\Member;
use Modules\ProfileManagement\Entities\Vital;
use Modules\ProfileManagement\Entities\Designation;
use Modules\ProfileManagement\Entities\Relative;
use Modules\ProfileManagement\Entities\Salutation;
use Modules\ContactManagement\Entities\Telephone;
use Modules\ContactManagement\Traits\ContactTrait;
use Modules\ClientManagement\Traits\OrganizationTrait;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use App\Notifications\AccountCreated;
use Carbon\carbon;
use Session;
use Image;
use File;
use DB;
use Mail;
use Modules\LocationManagement\Traits\AddressTrait;

trait ProfileTrait {
use OrganizationTrait, ContactTrait, AddressTrait;

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


    public function saveMember($profile = null)
    {
        //$this->data['role_id'] = 5;
        if(is_null($profile) && empty($this->data['profile_id']))
        {
            $profile = $this->saveProfile();
        }
        $member = new Member;
        $member->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $profile->id;
        // $member->income = !empty($this->data['income']) ? $this->data['income'] : NULL;
        // $member->currency = !empty($this->data['currency']) ? $this->data['currency'] : 'NGN';
        $member->occupation = !empty($this->data['occupation']) ? $this->data['occupation'] : NULL;
        $member->designation_id = !empty($this->data['designation_id']) ? $this->data['designation_id'] : NULL;
        if (!$member->save()) {
            return redirect()->back()->withInput()->withErrors('Something went wrong');
        }
        return $member;
    }

    public function SaveVital()
    {
        $this->vital = new Vital;
        $this->vital->profile_id = $this->data['profile_id'] ;
        $this->vital->blood_group = !empty($this->data['blood_group']) ? $this->data['blood_group'] : '';
        $this->vital->genotype = !empty($this->data['genotype']) ? $this->data['genotype'] : '';
        $this->vital->height = !empty($this->data['height']) ? $this->data['height'] : '';
        $this->vital->weight = !empty($this->data['weight']) ? $this->data['weight'] : '';
        $this->vital->complexion = !empty($this->data['complexion']) ? $this->data['complexion'] : '';
        $this->vital->eye_colour = !empty($this->data['eye_colour']) ? $this->data['eye_colour'] : '';
        $this->vital->hair_colour = !empty($this->data['hair_colour']) ? $this->data['hair_colour'] : '';
        $this->vital->tribal_marks = !empty($this->data['tribal_marks']) ? $this->data['tribal_marks'] : '1';

        if ( ! $this->vital->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->vital;
    }

    public function makemember()
    {

        if($this->SaveProfile())
        {
            if($this->addUser()){
                return $this->user;
            }
            return $this->profile->delete();
        }
    }


    public function saveProfile()
    {
        if(isset($this->data['profile_id']) || isset($this->profile_id))
        {
            return Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] :$this->profile_id);
        }

        return $this->makeProfile();
    }

    public function makeProfile()
    {
        if(isset($this->data['organization_name']))
        {
            $organization = $this->makeOrganization();
            $this->data['organization_id'] = $organization->id;
        }
        $profile = new Profile;
        $profile->role_id = !empty($this->data['role_id']) ? $this->data['role_id'] : $this->getDefaultRoleId();
        $profile->country_id = !empty($this->data['country_id']) ? $this->data['country_id'] : NULL;
        $profile->first_name = !empty($this->data['sponsor_firstname']) ? $this->data['sponsor_firstname'] :$this->data['first_name'] ;
        $profile->last_name = !empty($this->data['sponsor_lastname']) ? $this->data['sponsor_lastname'] :$this->data['last_name'] ;
        $profile->middle_name = !empty($this->data['middle_name']) ? $this->data['middle_name'] : NULL;
        $profile->salutation = !empty($this->data['salutation']) ? $this->data['salutation'] : NULL;
        $profile->gender = !empty($this->data['gender']) ? $this->data['gender'] : NULL;
        $profile->religion = !empty($this->data['religion']) ? $this->data['religion'] : NULL;
        $profile->primary_language = !empty($this->data['primary_language']) ? $this->data['primary_language'] : NULL;
        $profile->bio = !empty($this->data['bio']) ? $this->data['bio'] : NULL;
        $profile->birthplace = !empty($this->data['birthplace']) ? $this->data['birthplace'] : NULL;
        $profile->nationality = !empty($this->data['country_code']) ? $this->data['country_code'] : NULL;
        $profile->birthday = !empty($this->data['birthday']) ? $this->data['birthday'] : NULL;
        $profile->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : NULL;
        $profile->email = !empty($this->data['email']) ? $this->data['email'] : NULL;
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
            if(isset($this->data['address_no']))
            {
                $this->saveAddress($profile);
            }
            if(isset($this->data['relationship_id']))
            {
                $this->makeRelative();
            }
        return $profile;
        }

        return redirect()->back()->withInput()->withErrors('error', 'Cant create a profile for the specified user');

    }


    public function savePhone($profile = null)
    {
        if(is_null($profile))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] :$this->profile_id);
        }
        $telephone = new Telephone;
        $dialling_code = !empty($this->data['dialling_code']) ? $this->data['dialling_code'] : '234';
        $telephone->phone_number = $dialling_code.substr(!empty($this->data['telephone']) ? $this->data['telephone'] : $this->telephone,-10);
        $telephone->phone_tag = !empty($this->data['phone_tag']) ? $this->data['phone_tag'] : 'Default';
        if(!$profile->telephones()->save($telephone))
        {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again');
        }
        return $telephone;

    }

    public function makeRelative()
    {
        $this->relative = new Relative;
        $this->relative->person_id = !empty($this->data['person_id']) ? $this->data['person_id'] : $this->profile_id;
        $this->relative->related_person_id = !empty($this->data['related_person_id']) ? $this->data['related_person_id'] : $this->profile_id;
        $this->relative->relationship_id = $this->data['relationship_id'];
        $this->relative->priority = !empty($this->data['priority']) ? $this->data['priority'] : '0';
        if(!$this->relative->save())
        {
            return redirect()->back()->withInput()->withErrors('error', 'Cant create a relative for the specified user');
        }
        return $this->relative;
    }
    public function getProfileTypeId()
    {
        if(isset($this->data['designation_id']) || isset($this->designation_id)){
            $designation = Designation::findOrFail(!empty($this->data['designation_id']) ? $this->data['designation_id'] : $this->designation_id);
            $this->department_id = $designation->Role->department_id;
        }else{
            $profile_type = RoleCategory::where('is_default', true)->first();
            $this->department_id = $profile_type->id ;
        }
        return $this->department_id;
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


    // public function generateReferralCode()
    // {
    //     return trim($profile->first_name).rand(1111,9999);
    // }

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

    public function addUser($profile = null)
    {
        if(is_null($profile))
        {
            $profile = Profile::findOrFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile->id);
        }
        $user = new User;
        $user->telephone = !empty($this->data['telephone']) ? $this->data['telephone'] : $profile->telephone;
        $user->email = !empty($this->data['email']) ? $this->data['email'] : $profile->email;
        $user->password = Hash::make(!empty($this->data['password']) ? $this->data['password'] : ucfirst($profile->last_name));
        $user->change_password = !empty($this->data['change_password']) ? $this->data['change_password'] : false;
        $user->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $profile->id;
        //$user->role_id = !empty($this->data['role_id']) ? $this->data['role_id'] : 5;
        $user->active = !empty($this->data['active']) ? $this->data['active'] :true;
        return $user->save();
    }

    public function makeUser($profile)
    {
        $this->data['change_password'] = true;
        if(!empty($profile->email))
        {
            $user = $this->addUser($profile);
            event(new Registered($user));
        }

    }

    protected function setup()
    {
        //$profiles = Profile::with('Designation', 'EmploymentType', 'EmployeeCategory')->get();
        $profiles = Profile::doesnthave('Users')->get();
        foreach($profiles as $profile)
        {
            $this->makeUser($profile);
        }
        dd('success', 'Data entry complete');
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
    public function notuser()
    {
        $roles = Role::whereProfileTypeId('2')->pluck("label", "id");
        $people = Person::doesnthave('user')->has('employee')->get();
        return view ( 'employees.notuser', compact('people', 'roles'));
    }

    public function allSalutations()
    {
        return Salutation::all()->pluck("title");
    }
    public function savePassportPhoto($profile)
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/profiles/')) {
                $profile_img = File::makeDirectory('images/profiles', 0777, true);
            }
            $filename = Str::slug($profile->name).'_'.time().'.'.$this->avatar->getClientOriginalExtension();
            $profile_photo = 'images/profiles/' . $filename;
            $profile->avatar     = $profile_photo;
            // upload image to server
            Image::make($this->avatar)->fit('389', '439', function ($constraint) {
                $constraint->upsize();
            })->save($profile_photo);

    }
}
