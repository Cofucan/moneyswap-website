<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Modules\LocationManagement\Entities\Country;
use Modules\ContentManagement\Entities\Instruction;
use Modules\RoleManagement\Entities\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Modules\ProfileManagement\Traits\ProfileTrait;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use ProfileTrait;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        /* if (auth()->user()->role == ‘admin’) {
            return ‘/backend’;
        } */
        return '/home';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {
        $instruction = Instruction::byTag('register');
        $dialingcodes = $this->resolveDialingCodes();
        $roles = $this->resolveSelfRegisterRoles();
        return view('auth.register', compact('dialingcodes', 'instruction', 'roles'));
    }

    private function resolveDialingCodes()
    {
        if (!Schema::hasTable('countries')) {
            return collect(['234']);
        }

        $dialingCodeColumn = collect(['dialling_code', 'dialing_code', 'phone_code'])
            ->first(function ($column) {
                return Schema::hasColumn('countries', $column);
            });

        if (!$dialingCodeColumn) {
            return collect(['234']);
        }

        $query = Country::query();
        if (Schema::hasColumn('countries', 'enabled')) {
            $query->where('enabled', true);
        }

        $codes = $query->whereNotNull($dialingCodeColumn)
            ->pluck($dialingCodeColumn)
            ->map(function ($code) {
                $value = trim((string) $code);
                return ltrim($value, '+');
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return $codes->isEmpty() ? collect(['234']) : $codes;
    }

    private function resolveSelfRegisterRoles()
    {
        if (!Schema::hasTable('roles')) {
            return collect();
        }

        $query = Role::query();

        if (Schema::hasColumn('roles', 'self_signup')) {
            $query->where('self_signup', true);
        } elseif (Schema::hasColumn('roles', 'register_self')) {
            $query->where('register_self', true);
        } elseif (Schema::hasColumn('roles', 'self_register')) {
            $query->where('self_register', true);
        }

        if (Schema::hasColumn('roles', 'enabled')) {
            $query->where('enabled', true);
        } elseif (Schema::hasColumn('roles', 'published')) {
            $query->where('published', true);
        }

        $labelColumn = collect(['public_label', 'label', 'role_name'])
            ->first(function ($column) {
                return Schema::hasColumn('roles', $column);
            });

        if (!$labelColumn) {
            return collect();
        }

        return $query->orderBy($labelColumn)->pluck($labelColumn, 'id');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:10'],
            //'role_id' => ['required', 'number', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            '_answer'=>'required|simple_captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $this->data= $data;
        $user = $this->makeProfile();
        if($user)
        {
            return $user;
        }
        dd('Profile creation error');
    }
}
