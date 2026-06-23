<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Instruction;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        /* if (auth()->user()->role_id == 1) {
            return '/backend';
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
        $this->middleware('guest')->except('logout');
    }
   /*  protected function authenticated(Request $request, $user)
    {
        \Auth::logoutOtherDevices($request('password'));
    } */
    /* public function username()
    {
        return filter_var(request('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'telephone';
    } */
    public function showLoginForm() {
        $instruction = Instruction::byTag('login');
        return view('auth.login', compact('instruction'));
    }

}
