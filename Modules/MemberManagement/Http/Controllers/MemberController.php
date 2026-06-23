<?php

namespace Modules\MemberManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\MemberManagement\Entities\Member;
use Modules\ContentManagement\Entities\Page;
use Modules\ProfileManagement\Entities\Agent;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\SchoolManagement\Entities\Program;
use Modules\DocumentManagement\Entities\DocumentType;
use Modules\ProfileManagement\Entities\Relationship;
use Modules\SchoolManagement\Entities\Level;
use Modules\EnrolmentManagement\Entities\Enrolment;
use Modules\ClientManagement\Entities\ClientCategory;
use Modules\SchoolManagement\Entities\School;
use Modules\MemberManagement\Entities\Requirement;
use Modules\MemberManagement\Entities\MemberSchedule;
use Modules\SchoolManagement\Entities\Campus;
use Modules\AssessmentManagement\Entities\Screening;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\MemberManagement\Traits\MemberTrait;
use Illuminate\Http\Request;
use Modules\MemberManagement\Exports\MembersExport;
use Modules\MemberManagement\Imports\MembersImport;
use Modules\MemberManagement\Entities\MemberGrade;
use Excel;
use Auth;
use PDF;
use Carbon\carbon;
use Session;
class MemberController extends Controller
{
    use MemberTrait;
    public function __construct()
    {
       /*  $this->statuses = [
            'Diagnosed' => 'Diagnosed',
            'Treatment' => 'Treatment',
            'Recovered' => 'Recovered',
        ];
        $this->severities = [
            'Mild' => 'Mild',
            'Severe' => 'Severe',
            'Critical' => 'Critical',
            'Minor' => 'Minor',
        ]; */

    }
    public function upload()
    {

        return view('membermanagement::members.upload');
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

    public function manage()
    {
        $total = $this->memberstats();
        $members = Member::byStatus('Scheduled')->get();
        return view('membermanagement::members.manage', compact('members', 'total'));
    }

    public function join()
    {
        $total = $this->memberstats();
        $members = Member::byStatus('Scheduled')->get();
        return view('membermanagement::members.join', compact('members', 'total'));
    }

    public function process(Request $request)
    {
        $this->validate($request, [
           'member_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        $member = $this->processMember();
        if($member)
        {
            return redirect()->route($this->destination, $member)->with('success','Action performed successfully.');
        }

    }
    public function status($status)
    {
        $total = $this->memberstats();
        $members = Member::byStatus($status)->get();
        return view('membermanagement::members.manage', compact('status', 'members', 'total'));
    }

    public function home()
    {
        //
        // $school = Auth::user()->profile->Organization->school;
        $memberschedules = MemberSchedule::active()->get();
        $membergrades = MemberGrade::active()->get();
        $requirements = Requirement::active()->get();
        $academicTerms = AcademicTerm::active()->get();
        $documentTypes = DocumentType::all()->pluck("document_type", "id");
        $levels = Level::active()->pluck("label", "id");
        $programs = Program::active()->get();
        return view('membermanagement::members.home', compact('academicTerms', 'memberschedules', 'membergrades','documentTypes', 'requirements','levels', 'programs'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'member';
        $page = Page::where('page_tag', $page_tag)->first();
        $programs = Program::active()->pluck("label", "id");
        $screenings = Screening::whereDate('screening_datetime', '>=', Carbon::today()->toDateString())->get();
        return view('membermanagement::members.index', compact('page', 'programs', 'screenings'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academicTerms = AcademicTerm::active()->pluck("label", "id");
        $agents = Agent::active()->get();
        $relationships = Relationship::all()->pluck("label", "id");
        $levels = Level::active()->pluck("label", "id");
        $clientcategories = ClientCategory::active()->pluck("label", "id");
        $campuses = Campus::active()->pluck("label", "id");
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];
        $states = State::all()->pluck("state_name", "id");
        $countries = Country::all()->pluck("citizen_title", "country_code");
        return view('membermanagement::members.create', compact('academicTerms', 'agents', 'countries', 'relationships', 'clientcategories', 'addressPrefix', 'states', 'levels', 'campuses'));
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
            'grade_id' => 'required',
            'client_category_id' => 'required',
            'academic_term_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'stream_id' => 'required'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('avatar')) {
            $this->avatar = $request->file('avatar');
        }
        if(empty($request->agent_id))
        {
            $this->data['agent_id'] = $this->saveFamily()->id;
        }
        $this->data['role_id'] = 9;
        $member = $this->saveMember();
        if ( !$member){
            return redirect()->back()->with('error', 'Member entry could not be generated. please check your data and try again');
        }
        return redirect()->route('members.show', $member)->with('success','Client Record Created and submitted for approval.');

    }

    public function bulkstore(Request $request)
    {
        $this->validate($request, [
            'registrations' => 'required',
            'status' => 'required'
        ]);
        //dd($request->all());
        $this->data = $request->all();
        foreach($request->registrations as $key => $value) {
           // $this->member = new Member;
            $this->data['registration_id'] = $value;
            if ( ! $this->saveMember()){
                return redirect()->back();
            }
            if($this->member->status =='Offered'){
                $this->processMember();
            }
        }
        return redirect()->route('members.show', $this->member->id)->with('success','Member record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //$ailments = Ailment::wherePublished(true)->pluck("name", "id");
        //$statuses = $this->statuses;
        $states = State::all()->pluck("state_name", "id");
        //$severities = $this->severities;
        //$activityTypes = ActivityType::all()->pluck("public_name", "activity_type");
        $countries = Country::all()->pluck("citizen_title", "country_code");
        return view('membermanagement::members.show', compact('member', 'countries', 'states'));
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
        $levels = Level::active()->pluck("label", "id");
        $clientcategories = ClientCategory::active()->pluck("label", "id");
        return view('membermanagement::members.edit', compact('member','levels', 'clientcategories'));
    }

    public function clients()
    {
        $members = Member::query()
        ->addSelect(['last_grade' => Enrolment::select('grade_id')
            ->whereColumn('member_id', 'members.id')
            ->latest()
            ->take(1)
        ])
       // ->withCasts(['last_login_at' => 'datetime'])
        ->get();
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
        $this->validate($request, [
            'academic_term_id' => 'required',
            'grade_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        if( !$member->update($request->all())) {
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
        $member->delete();
        return redirect()->back()
                        ->with('success','Member details deleted successfully');
    }
}
