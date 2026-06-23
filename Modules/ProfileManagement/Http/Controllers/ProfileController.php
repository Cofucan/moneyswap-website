<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\ClientManagement\Entities\Client;
use Modules\ContactManagement\Entities\ContactType;
use Modules\OrganizationManagement\Entities\Organization;
use Modules\ProfileManagement\Entities\Religion;
use Modules\ProfileManagement\Entities\Agent;
use Modules\ProfileManagement\Entities\Relationship;
use Modules\ProfileManagement\Entities\Profile;
use Modules\RoleManagement\Entities\RoleCategory;
use Modules\RoleManagement\Entities\Role;
use Modules\ProfileManagement\Exports\ProfilesExport;
use Modules\ProfileManagement\Imports\ProfilesImport;
use Modules\ProfileManagement\Mail\UserWelcome;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\carbon;
use Mail;
use Image;
use Auth;
use Excel;
use File;
use Session;
use Storage;

class ProfileController extends Controller
{
    use ProfileTrait;

    public function __construct()
    {
        // $this->middleware(['auth','verified']);
        $this->phoneTags = [
            'Work' => 'Work',
            'Default' => 'Default',
            'Home' => 'Home',
            'Other' => 'Other',
        ];
    }

    public function search(Request $request)
    {
        try {
            $profile = Profile::where('referral_code', $request->referral_code);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->route('profiles.show', $profile->id);
    }

    public function users()
    {
        $roles = Role::active()->pluck("label", "id");
        $users = User::active()->get();
        return view ('profilemanagement::users.manage', compact('users','roles'));
    }

    public function management()
    {
       $profiles = Profile::management()->get();
        return view ('profilemanagement::profiles.directors', compact('profiles'));
    }

    public function webcam()
    {
        return view('profilemanagement::profiles.selfie');
    }
    public function capture(Request $request)
    {
        $img = $request->image;
        $folderPath = "uploads/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        dd('Image uploaded successfully: '.$fileName);
    }
    public function activator()
    {
        $user = Auth::user();
        $user->enabled = true;
        $user->profile->enabled = true;
        $user->push();
        //Mail::to($user->email)->send(new UserWelcome($user));

        switch (Auth::user()->Profile->role_id) {
            case '1': //admin
            break;
            case '2':
            break;
            case '3':
            break;
            case '4'://cashier

            break;

            case '9'://agent
                return redirect()->route('profiles.edit', $user->profile)->with('success','Thanks for verifying your email address, kindly update your profile to proceed!');
            break;
            case '10'://Client
                return redirect()->route('profiles.edit', $user->profile)->with('success','Thanks for verifying your email address, you are almost done!');
            break;
            default:
            Auth::logout();
            return view('profiles.activated', compact('user'));
        }

    }
    public function reverify(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'email' => 'required|string|email|max:100|unique:users'
        ]);
        $user = User::findorFail($request->user_id);

        if(!$user->sendEmailVerificationNotification())
        {
            $heading = 'error';
            $response = 'Could not send verification email';
        }
        $heading = 'success';
        $response = 'Email verification code sent successfully';
        return redirect()->back()->with($heading,$response);
    }

    public function swapemail(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'email' => 'required|string|email|max:100|unique:users'
        ]);
        $user = User::findorFail($request->user_id);
        $user->email = $request->email;
        $user->profile->email = $user->email;
        if(!$user->push())
        {
            $heading = 'error';
            $response = 'Could not update email';
        }
        $heading = 'success';
        $response = 'Login Email Address Updated Successfully';
        return redirect()->back()->with($heading,$response);
    }

    public function setpassword(Request $request)
    {

        $this->validate($request, [
            'email' => 'required'
        ]);
        dd($request->all());
        $credentials = ['email' => $request->email];
        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject($this->getEmailSubject());
        });
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));
            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function removeuser(User $user)
    {
        $user->delete();
        return redirect()->back()
                        ->with('success','User deleted successfully');
    }


    public function user(User $user)
    {
        /* $chart_options = [
            'chart_title' => 'Logins weeks',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        return view ( 'people.registrations', compact('users', 'chart1')); */
        return view ('users.show', compact('user'));
    }
    public function changerole(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'role_id' => 'required'
        ]);
        $profile = Profile::findorFail($request->profile_id);
        $profile->role_id = $request->role_id;
        if(!$profile->save())
        {
            $heading = 'error';
            $response = 'Could not change profile role';
        }
        $heading = 'success';
        $response = 'User role Updated Successfully';
        return redirect()->back()->with($heading,$response);
    }
    public function changepassword(){

        return view('auth.changepassword')->with('warning', 'Kindly change your password to the one you can remember');
    }

    public function updatepassword(Request $request)
    {
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());
        $hashedPassword = $user->password;
        if (Hash::check($request->current, $hashedPassword)) {
            $user->update([
                'password_change_at' => Carbon::now()->toDateTimeString(),
                'change_password' => '0',
                'password' => Hash::make($request->password)
            ]);
            Auth::logout();
            return redirect(route('login'))->with('success', 'Your password has been changed.');
        }
        $request->session()->flash('failure', 'Your password has not been changed.');
        return back();
    }

    public function upload()
    {
       return view('profilemanagement::profiles.upload');
    }

    public function export()
    {
        return Excel::download(new ProfilesExport, 'profiles.xlsx');
    }

    public function import()
    {
        Excel::import(new ProfilesImport, request()->file('file'));
        return redirect()->back()->with('success', 'Data imported successfully');
    }
    // use RegistersUsers;
     /**
     * Where to redirect users after registration.
     *
     * @var string
     */



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {

        $roles = Role::active()->pluck("role_name", "id");
        $roleCategories = RoleCategory::where('profile_type', '<>', 'IT')->pluck("public_name", "id");
        return view('profilemanagement::profiles.new', compact('roleCategories', 'roles'));
    }


    protected function makeuser(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'email' => 'required'
        ]);
        $this->data = $request->all();
        if($this->signupProfile())
        {
            return redirect()->back()->with('success','User Account Setup Successfully.');
        }

    }

    public function changephoto(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'avatar' => 'required',
            'avatar.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);
        $this->profile = Profile::findorFail($request->profile_id);
        if ($request->hasFile('avatar')) {
            $this->avatar = $request->file('avatar');
            $this->saveAvatar() ;
            $this->profile->save();
        }
        return redirect()->back()->with('success', 'Passport updated successfully');

    }

    public function saveAvatar()
    {
        // create new directory for uploading image if doesn't exist
        if ( ! File::exists('images/people/')) {
            $profile_img = File::makeDirectory('images/people', 0777, true);
        }
        $filename = Str::slug($this->profile->name).'_'.time().'.'.$this->avatar->getClientOriginalExtension();
        $profile_photo = 'images/people/' . $filename;
        $this->profile->avatar     = $profile_photo;
        // upload image to server
        Image::make($this->avatar)->save($profile_photo);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries=Country::get()->pluck("label", "code");
        $profiles = Profile::with('Role')->get();
        return view('profilemanagement::profiles.index', compact('profiles', 'countries' ));
    }

    public function manage()
    {
        $countries=Country::all()->pluck("name", "id");
        $profiles = Profile::with('Role', 'Organization')->get();
        return view('profilemanagement::profiles.manage', compact('profiles', 'countries'));
    }

    public function rolecategory($rolecategory)
    {
        $countries=Country::get()->pluck("label", "id");
        $this->rolecategory = $rolecategory;
        $profiles = Profile::with('Role')->whereHas('RoleCategory', function($query){
            $query->where('profile_type', $this->rolecategory)->orderBy('created_at', 'Desc');
        })->get();
        return view('profilemanagement::profiles.manage', compact('profiles', 'rolecategory', 'countries', 'rolecategory'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'role_id' => 'required'
        ]);
        $this->data = $request->all();
        if($this->saveProfile())
        {
            return redirect()->back()
                        ->with('success','profile created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
        $phoneTags = $this->phoneTags;
        $relationships = Relationship::all()->pluck("relationship");
        $countries = Country::all()->pluck("citizen_title", "code");
        return view('profilemanagement::profiles.show',compact('profile', 'countries', 'relationships','phoneTags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */

    public function edit(Profile $profile)
    {
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];
        $regions = Country::active()->get();
        $nationalities = $regions->pluck("citizen_title", "code");
        $countries = $regions->pluck("label", "code");
        $states = State::all()->pluck("state_name", "id");
        $religions = Religion::active()->pluck("label", "id");
        return view('profilemanagement::profiles.edit',compact('addressPrefix','profile', 'countries', 'religions','nationalities', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {

        dd($profile->id);

        if(isset($request->street_name) && isset($request->neighbourhood_name))
        {
            $this->data = $request->all();
            $address = $this->saveAddress();
            $request->merge([
                'address_id' => $address->id
            ]);
        }

        if( ! $profile->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }

        
        return redirect()->back()->with('success','Profile details Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
        $profile->delete();
        return redirect()->back()
                        ->with('success','profile deleted successfully');
    }
    public function userdestroy(User $user)
    {
        //
        $user->delete();
        return redirect()->back()
                        ->with('success','user deleted successfully');
    }
}
