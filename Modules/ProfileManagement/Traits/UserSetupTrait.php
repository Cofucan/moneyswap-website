<?php
namespace Modules\ProfileManagement\Traits;
use Modules\ProfileManagement\Entities\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Notifications\AccountCreated;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Auth\Events\Registered;
use Carbon\carbon;
use Session;
use Mail;

trait UserSetupTrait {
    use RegistersUsers;
    use ProfileTrait;


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
    public function makeUser($profile)
    {
        $this->data['change_password'] = true;
        if(!empty($profile->email))
        {
            $user = $this->addUser($profile);
            event(new Registered($user));
        }

    }

   

}
