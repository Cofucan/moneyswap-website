<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\RequiredDocument;
use App\Models\Profile;
use App\Models\Page;
use App\Models\Country;
use App\Models\Salutation;
use Illuminate\Support\Str;
use App\Traits\ProfileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Carbon\carbon;
use File;
use Auth;
use Image;
use Session;

class ProfileController extends Controller
{
    use ProfileTrait;
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
    public function setpassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);
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

    public function changepassword(){
        return view('auth.changepassword')->with('warning', 'Kindly change your password to the one you can remember');
    }

    public function updatepassword(Request $request)
    {
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        $hashedPassword = $user->password;
        if (Hash::check($request->current, $hashedPassword)) {
            $user->update([
                'password_change_at' => Carbon::now()->toDateTimeString(),
                'change_password' => '0',
                'password' => Hash::make($request->password)
            ]);
            Auth::logout();
            return redirect(route('login'))->with('success', 'Your password has been Changed Successfully!');
        }
        $request->session()->flash('failure', 'Your password has not been changed.');
        return back();
    }

    public function process(Request $request)
    {
        $this->validate($request, [
           'profile_id' => 'required',
           'status' => 'required'
        ]);
        $this->data = $request->all();
        if($this->ProfileProcessor())
        {
            return redirect()->back()->with('success','Action performed successfully.');
        }
    }

    public function selfie()
    {
        return view('profiles.selfie');

    }

    public function changephoto(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'avatar' => 'required',
            'avatar.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);
        $this->profile = Profile::findorFail($request->profile_id);
        if($request->upload_type =='selfie')
        {
            $image_parts = explode(";base64,", $request->avatar);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';
            $file = 'images/profiles/avatar/' . $fileName;
            if(file_put_contents($file, $image_base64))
            {
                $this->profile->avatar = $file;
            }
        }else{
            if ($request->hasFile('avatar')) {
                $this->avatar = $request->file('avatar');
                $this->saveAvatar() ;
            }
        }
        if($this->profile->save())
        {
            if ($this->profile->role_id == 5) {
                if(RequiredDocument::whereProfileId($this->profile->id)->doesntExist())
                {
                    return redirect()->route('requireddocuments.create')->with('success','Profile Updated Successfully.');
                }
           }
           return redirect()->back()->with('success', 'Passport updated successfully');
        }
        return redirect()->back()->with('info', 'Incomplete Operation');
    }

    public function saveAvatar()
    {
        // create new directory for uploading image if doesn't exist
        if ( ! File::exists('images/profiles/avatar/')) {
            $profile_img = File::makeDirectory('images/profiles/avatar/', 0777, true);
        }
        $filename = Str::slug($this->profile->last_name).'_'.time().'.'.$this->avatar->getClientOriginalExtension();
        $profile_photo = 'images/profiles/avatar/' . $filename;
        $this->profile->avatar     = $profile_photo;
        // upload image to server
        Image::make($this->avatar)->fit('389', '439', function ($constraint) {
            $constraint->upsize();
        })->save($profile_photo);
    }

    public function home()
    {
        $profiles = Profile::with('Role', 'Country', 'Organization')->get();
        return view('profiles.manage', compact('profiles'));
    }

    public function pending()
    {
        $profile = Auth::user()->Profile;
        $page = Page::byTag('awaiting-approval');
        return view('profiles.pending', compact('profile', 'page'));
    }

    public function manage()
    {
        $profiles = Profile::pending()->get();
        return view('profiles.manage', compact('profiles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
        $countries = Country::active();
        $documenttypes = DocumentType::active()->get();
        return view('profiles.show', compact('profile', 'documenttypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $salutations = Salutation::pluck("label");
        return view('profiles.edit', compact('profile', 'salutations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'gender' => 'required',
            'birthday' => 'required',
            'reference_document.*' => 'image|mimes:jpeg,jpg,png,gif|max:8000'
        ]);

        if(isset($request->street_address) )
        {
        // dd($request->all());
            $this->data = $request->all();
            $this->saveAddress();
        }
        if ( ! $profile->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('Something went wrong');
        }
        return redirect()->route('selfie')->with('success','Profile Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
        $profile->delete();
        return redirect()->back()
                        ->with('success','Profile deleted successfully');
    }
}
