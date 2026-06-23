<?php

namespace Modules\MembershipManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\InvoiceManagement\Entities\Invoice;
use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\HowItWork;
use Modules\ContentManagement\Entities\Advantage;
use Modules\MembershipManagement\Entities\Requirement;
use Modules\ContactManagement\Entities\ContactType;
use Modules\MembershipManagement\Entities\Member;
use Modules\RoleManagement\Entities\Role;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
use Auth;
use Excel;
use File;
use Modules\MembershipManagement\Entities\MembershipType;
use Modules\OrganizationManagement\Entities\Industry;
use Modules\OrganizationManagement\Entities\OrganizationType;
use Session;

class MemberController extends Controller
{
    use ProfileTrait;

    public function __construct()
    {
        // $this->middleware(['auth','verified']);
        $this->contactTags = [
            'Work' => 'Work',
            'Default' => 'Default',
            'Home' => 'Home',
            'Other' => 'Other',
        ];

    }

    // use RegistersUsers;
     /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    public function payments(Member $member)
    {
        $revenues = $member->Revenues;
        return view('revenues.manage', compact('revenues'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {

        return view('membershipmanagement::members.create');
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
        return view('membershipmanagement::members.index', compact('members', 'page' ));
    }

    public function home()
    {
        $page_tag = 'membership';
        $page = Page::where('page_tag', $page_tag)->first();
        $requirements = Requirement::active()->get();
        $howitworks = HowItWork::membership()->get();
        $advantages = Advantage::members()->get();
        return view('membershipmanagement::members.home', compact('page', 'requirements', 'howitworks', 'advantages'));
    }

    public function manage()
    {
        $members = Member::with('Profile')->get();
        return view('membershipmanagement::members.manage', compact('members'));
    }

    public function join()
    {
        $page_tag = 'membership';
        $page = Page::where('page_tag', $page_tag)->first();
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
        ];
        $membershiptypes = MembershipType::active()->pluck("label", "id");
        $organizationtypes = OrganizationType::active()->pluck("label", "id");
        $industries = Industry::active()->pluck("label", "id");
        $countries = Country::active()->get();
        // $telcodes = Country::active();
        $states = State::all()->pluck("state_name", "id");
        return view('membershipmanagement::members.join', compact('countries',  'industries','organizationtypes','membershiptypes','states','page'));
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
        return redirect()->route('members.preview', $member)->with('success','Member Added successfully.');
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
        $contactTypes = ContactType::all()->pluck("contact_type");
        $contactTags = $this->contactTags;
        $countries = Country::all()->pluck("citizen_title", "country_code");
        return view('membershipmanagement::members.show',compact('member', 'countries','contactTypes','contactTags'));
    }

    public function preview(Member $member)
    {
        //
        $countries = Country::all()->pluck("citizen_title", "country_code");
        return view('membershipmanagement::members.preview',compact('member'));
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
        return view('membershipmanagement::members.edit',compact('member'));
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
