<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Page;
use App\Models\Member;
use App\Models\ContactType;
use App\Models\Currency;
use App\Traits\MemberTrait;
use Illuminate\Http\Request;
use App\Exports\MembersExport;
use App\Imports\MembersImport;
use App\Models\Bank;
use App\Models\Relationship;
use DB;
use PDF;
use Auth;
use Session;
use Excel;
use File;
use Share;
use Image;

class MemberController extends Controller
{
    use MemberTrait;
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];
        $this->contactTags = [
            'Work' => 'Work',
            'Default' => 'Default',
            'Home' => 'Home',
            'Other' => 'Other',
        ];
    }

    public function upload()
    {
       return view('members.upload');
    }

    public function export()
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    public function import()
    {
        Excel::import(new MembersImport, request()->file('file'));
        return redirect()->back()->with('success', 'Data imported successfully');
    }



    public function products()
    {
        $membershiptype = Auth::user()->Person->member->membershiptype;
        $products = $this->loadOrderable($membershiptype->id);
        return view ('members.products', compact('products', 'membershiptype'));
    }

    public function orders()
    {
        // dd(Auth::user());
        $member = Auth::user()->Person->Member;
        return view('members.orders', compact('member'));
    }

    public function descendants(Member $member)
    {
        //$member = $this->loadmember($reference_code);
            $descendants = $member->descendants->toFlatTree();
            //dd($descendants);
        return view('members.descendants', compact('descendants', 'member'));
    }

    public function ancestors(Member $member)
    {
        $result = Member::defaultOrder()->ancestorsOf($member->id);
    }

    public function children(Member $member)
    {
        return view('members.children', compact('member'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       /*  set_time_limit(0);
        $members = Member::with('Profile')->get();
        foreach($members as $member)
        {
            $profile = $member->Profile;
            $member->parent_id = !empty($profile->profile_id) ? $profile->profile_id : '1';
            $member->person_id = $profile->person_id;
            $member->referral_code = $profile->referral_code;
            $member->reference_code = NULL;
            $member->save();
        } */
        return view('members.index', compact('members'));
    }
    public function kyc()
    {
        $page_tag = 'membership-kyc';
        $page = Page::where('page_tag', $page_tag)->first();
        $currencies = Currency::all()->pluck("currency_name", "currency");
        $banks = Bank::with('Organization')->get();
        $relationships= Relationship::all()->pluck("label","id");
        return view('members.kyc',compact('relationships', 'banks', 'currencies', 'page'));
    }

    public function kycprocessor(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'member_id' => 'required',
            'bank_id' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
            'relationship_id' => 'required'
        ]);
        $this->data = $request->all();

        if(!$this->addNextofkin()){
            return redirect()->back()->withInput()->withErrors('error', 'Could not create next of kin');
        }
        if(!$this->saveMemberAccount()){
            return redirect()->back()->withInput()->withErrors('error', 'Could not create next of Bank Account');
        }
        $member = $this->memberaccount->member;
        $member->status = 'Completed';
        $member->save();
        return redirect(route('home'))->with('success', 'Registration completed.');
    }

    /**
     * Show the form for creat ing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::where('published', true)->pluck("section_name", "id");
        $clientcategories = ClientCategory::where('published', true)->pluck("student_type", "id");
        $countries = Country::all()->pluck("citizen_title", "country_code");
        $sponsor_states = State::all()->pluck("state_name", "id");
        $enrolmentStatuses = EnrolmentStatus::all()->pluck("display_name", "enrolment_status");
        $addressPrefix = $this->addressPrefix;
        $cities = City::all()->pluck("city_name", "id");
        return view('members.create', compact('clientcategories', 'addressPrefix', 'sections', 'enrolmentStatuses', 'countries', 'cities', 'sponsor_states'));
    }

    public function toggle(Member $member)
    {
        if ($member->status == 'Active') {
            $member->status = 'Disabled';
            $member->person->user->status = 'Disabled';
            $feedback = $member->person->candidate_name. ' Account deactivated successfully';
        } else {
            $member->status = 'Active';
            $member->person->user->status = 'Active';
            $feedback = $member->person->candidate_name. ' Account Activated successfully';
        }
        if ( ! $member->push()) {
            return redirect()->back()->with('error', 'Could not update Outlet');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function manage()
    {
        //set_time_limit(0);
        //Member::fixTree();
        $members = Member::with('Person','MembershipType', 'Parent')->has('Person.user')->get();
        return view('members.manage', compact('members'));
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
            'level_id' => 'required',

        ]);
        $this->data = $request->all();
        if ($request->hasFile('passport_photo')) {
            $this->passport_photo = $request->file('passport_photo');
        }
        if($this->savePerson())
        {
            $admission =  $this->saveAdmission();
            $this->data['milestone_id'] =  $admission->id;
            //$this->data['person_id'] =  $this->person->id;
            $this->saveStudent();
        }
        if($this->saveAddress())
        {
            $this->PersonAddress();
        }
        return redirect()->route('members.show', $this->member->id)->with('success','Member Added successfully.');
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
        $contactTags = $this->contactTags;
        $contactTypes = ContactType::all()->pluck("contact_type");
        $addressPrefix = $this->addressPrefix;
        $states = State::all()->pluck("state_name", "id");
        $currencies = Currency::all()->pluck("currency_name", "currency");
        $banks = Bank::with('Organization')->get();
        $relationships = Relationship::all()->pluck("label", "id");
        return view('members.show',compact('member', 'contactTypes', 'contactTags', 'addressPrefix', 'states', 'banks', 'currencies', 'relationships'));
    }

    public function preview(Member $member)
    {
        return view('members.preview', compact('member'));
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
        return view('members.edit',compact('member'));
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
        $this->validate($request, [
            'payment_method' => 'required',
            'status' => 'required'
        ]);
        if( ! $member->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->route('members.show', $this->member->id)->with('success','Member Updated successfully.');
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
                        ->with('success','Member deleted successfully');
    }
}
