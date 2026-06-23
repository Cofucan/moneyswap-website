<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\Volunteer;
use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\HowItWork;
use Modules\ProfileManagement\Entities\Profile;
use Modules\CatalogManagement\Entities\Expertise;
use Modules\ProjectManagement\Entities\Cause;
use Modules\LocationManagement\Entities\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\HumanResources\Traits\VolunteerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Notifications\AccountCreated;
use Carbon\carbon;
use DB;
use Session;

class VolunteerController extends Controller
{
    use VolunteerTrait;
    use RegistersUsers;
    Public function __construct()
    {


    }

    public function volunteerstats()
    {
    return DB::table('volunteer')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'Scheduled' then 1 end) as Scheduled")
    ->selectRaw("count(case when status = 'Pending' then 1 end) as Pending")
    ->selectRaw("count(case when status = 'Paid' then 1 end) as Paid")
    ->selectRaw("count(case when status = 'Closed' then 1 end) as Closed")
    ->selectRaw("count(case when status = 'Approved' then 1 end) as Approved")
    ->first();
    }

    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }
    public function manage()
    {
        $volunteercategories = VolunteerCategory::active();
        $volunteers = Volunteer::active()->get();
        return view('humanresources::volunteers.manage', compact('volunteers', 'volunteercategories'));
    }



    public function status($status)
    {
        $volunteers = Volunteer::byStatus($status)->get();
        return view('humanresources::volunteers.home', compact('status', 'volunteers'));
    }

    public function process(Request $request)
    {
        //
        $this->validate($request, [
            'volunteer_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        if(!$this->processVolunteer())
        {
            return redirect()->back()->with('error', 'Cannot update status to the same status');
        }
        return redirect()->back()->with('success', 'Volunteer Approved successfully');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'volunteer';
        $page = Page::where('page_tag', $page_tag)->first();
        $causes = Cause::active()->get();
        $howitworks = HowItWork::public()->get();
        return view('humanresources::volunteers.index', compact('page', 'causes', 'howitworks'));
    }

    public function home()
    {
        //
        $total = $this->investmentStats();
        $volunteer = Volunteer::orderBy('created_at', 'Desc')->take(10)->get();
        return view('humanresources::volunteers.home', compact('volunteers', 'total'));
    }


    public function preview(Volunteer $volunteer)
    {

        return view('humanresources::volunteers.preview', compact('volunteer'));
    }

    public function start($parent_code = null)
    {

        if(Auth::check())
         {
            return redirect()->route('volunteers.create')->with('info','Create A Volunteer Profile!');
         }

         $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
        ];
        $page_tag = 'volunteer';
        $page = Page::where('page_tag', $page_tag)->first();
        $countries = Country::active()->pluck("label", "id");
        $telcodes = Country::active()->pluck("dialling_code", "id");
        $expertises = Expertise::active()->get()->pluck("label", "id");
        // $volunteercategories = VolunteerCategory::active()->pluck("label", "id");
        return view('humanresources::volunteers.start', compact( 'addressPrefix', 'telcodes','countries', 'addressPrefix',  'expertises','page'));
    }

    public function certificate(Volunteer $volunteer)
    {
        if($volunteer->status == 'Pending')
        {
            return redirect()->route('volunteer.preview', $volunteer->reference_code)->with('info','Pending Volunteer!');
        }
        return view('humanresources::volunteers.certificate', compact('volunteer'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
        ];
        $countries = Country::active()->pluck("label", "id");
        $telcodes = Country::active()->pluck("dialling_code", "id");
        $expertises = Expertise::active()->get()->pluck("label", "id");
        // $volunteercategories = VolunteerCategory::active()->pluck("label", "id");
        return view('humanresources::volunteers.create', compact('expertises', 'telcodes', 'countries', 'addressPrefix'));
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
            // 'volunteer_category_id' => 'required',
            'cause_id' => 'required',
            'payment_method' => 'required',
            'capital' => 'required'
        ]);
        $this->data = $request->all() ;
        $volunteer = $this->saveVolunteer();
        if($volunteer){
            return redirect()->route('volunteer.preview', $volunteer)->with('success','Thank you for submitting your volunteer plan, Kindly make payment into any of our account details below.');
        }
    }

    public function signup(Request $request)
    {
        $this->validate($request, [
            'expertise_id' => 'required',
            'password' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'last_name' => 'required',
            'first_name' => 'required'
        ]);
        $this->data = $request->all();
        $user = User::whereEmail($request->email)->first();
        if(empty($user))
        {
            if ($request->hasFile('passport_photo')) {
                $this->passport_photo = $request->file('passport_photo');
            }
            if ( ! event(new Registered($this->makeMember()))) {
                return redirect()->back()->withInput()->withErrors('Error creating user profile');
            }
        }

        return redirect()->route('humanresources::volunteers.preview', $volunteer)->with('success','Thank you for submitting your volunteer plan, Kindly make payment into any of our account details below.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        //

        return view('humanresources::volunteers.show', compact('volunteer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        //
        $this->validate($request, [
            'anniversary' => 'required',
            'status' => 'required'
        ]);
        if( ! $investmentreturn->update($request->all())) {
            return redirect()->back()->withInput()->with('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Volunteer plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        //
        $volunteer->delete();
        return redirect()->back()
                        ->with('success','Volunteer deleted successfully');
    }
}
