<?php
namespace Modules\ProfileManagement\Traits;
use Modules\ProfileManagement\Entities\Profile;
use Modules\ProfileManagement\Entities\Person;
use Modules\RoleManagement\Entities\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\AccountCreated;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Auth\Events\Registered;
use Carbon\carbon;
use Session;
use Mail;

trait UserTrait {
use ProfileTrait;
use RegistersUsers;


    public function signupProfile(){
        $this->data['change_password'] = 1;
        $user = $this->addUser();
        return event(new Registered($user));
    }

    public function signup(){


        if($this->saveProfile())
        {
            $this->data['change_password'] = 1;
            $user = $this->addUser();
            return event(new Registered($user));
        }
    }






}
