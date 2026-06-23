<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\InvoiceManagement\Entities\Invoice;
use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\HowItWork;
use Modules\ContentManagement\Entities\Advantage;
use Modules\ProfileManagement\Entities\Requirement;
use Modules\ContactManagement\Entities\ContactType;
use Modules\ProfileManagement\Entities\Member;
use Modules\RoleManagement\Entities\Role;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
use Auth;
use Excel;
use File;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Session;

class MemberController extends Controller
{
    use ProfileTrait;



    // use RegistersUsers;
     /**
     * Where to redirect users after registration.
     *
     * @var string
     */

     public function teams()
     {
        $page_tag = 'our-team';
        $page = Page::where('page_tag', $page_tag)->first();
        $members = Member::active()->get(); 
        return view('profilemanagement::members.teams', compact('page', 'members'));
     }

    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {

        return view('profilemanagement::members.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'our-team';
        $page = Page::where('page_tag', $page_tag)->first();
        $members = Member::active()->paginate(8);
        return view('profilemanagement::members.index', compact('members', 'page' ));
    }

    public function home()
    {
        $page_tag = 'membership';
        $page = Page::where('page_tag', $page_tag)->first();
        $requirements = Requirement::active()->get();
        $howitworks = HowItWork::membership()->get();
        $advantages = Advantage::members()->get();
        return view('profilemanagement::members.home', compact('page', 'requirements', 'howitworks', 'advantages'));
    }

    public function manage()
    {

        $members = Member::with('Profile')->get();
        return view('profilemanagement::members.manage', compact('members'));
    }

    public function join()
    {
        $page_tag = 'membership';
        $page = Page::where('page_tag', $page_tag)->first();
        $countries = Country::all()->pluck("country_name", "dialing_code");
        $states = State::all()->pluck("state_name", "id");
        $telcodes = Country::active();

        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
        ];
        return view('profilemanagement::members.start', compact('countries', 'telcodes','addressPrefix' ,'states','page'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'telephone' => 'required',
        ]);
        $this->data = $request->all();
       $member = $this->saveMember();
        if ( !$member ) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, please try later');
        }
        return redirect()->route('members.show', $member)->with('success','Member Added successfully.');
    }

    public function toggle(Member $member)
    {
        if ($member->is_active == true) {
            $member->is_active = false;
            $feedback = 'Member Deactived successfully';
        } else {
            $member->is_active = true;
            $feedback = 'Member Activated successfully';
        }
        if ( ! $member->save()) {
            return redirect()->back()->with('error', 'Could not update Department');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
        $countries = Country::all()->pluck("citizen_title", "country_code");
        return view('profilemanagement::members.show',compact('member', 'countries'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
        return view('profilemanagement::members.edit',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
        if( ! $member->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        if($request->todo =='Continue')
        {
            //$resume = $this->getResumeId();
            return redirect()->route('employments.create')->with('success','Personal Records Updated.');
        }
        return redirect()->back()->with('success','Bio-Data Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
        $member->delete();
        return redirect()->back()
                        ->with('success','member deleted successfully');
    }
}
