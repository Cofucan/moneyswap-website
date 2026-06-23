<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\Resume;
use Modules\LocationManagement\Entities\Country;
use Modules\ProfileManagement\Entities\Profile;
use Modules\ContactManagement\Entities\ContactType;
use Modules\SocialManagement\Entities\SocialPlatform;
use Modules\LocationManagement\Entities\State;
use Modules\HumanResources\Entities\Qualification;
use Modules\SchoolManagement\Entities\Program;
use Modules\HumanResources\Traits\ResumeTrait;
use Illuminate\Http\Request;
use Session;
use Auth;
class ResumeController extends Controller
{
    use ResumeTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->visibilities = [
            'Public' => 'Public',
            'Recruiter' => 'Employers Only',
        ];

        $this->paymentCycles = [
            'One-off' => 'One Off',
            'Daily' => 'Day',
            'Weekly' => 'Week',
            'Monthly' => 'Month',
        ];
        $this->contactTags = [
            'Work' => 'Work',
            'Default' => 'Default',
            'Home' => 'Home',
            'Other' => 'Other',
        ];
        $this->addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
            ];

    }

    public function builder()
    {
        return view('humanresources::resumes.builder');
    }

    public function resumesearch()
    {
        //
        $resumes = Resume::with('Designation', 'Education', 'EmploymentType', 'Profile', 'Profile.Person')->get();
        return view('humanresources::resumes.search', compact('resumes'));
    }


    public function manage()
    {
        //
        $totalresumes = $this->resumeStats();
        $resumes = Resume::with('Designation', 'Education', 'EmploymentType', 'Profile', 'Profile.Person')->get();
        return view('humanresources::resumes.manage', compact('resumes', 'totalresumes'));
    }

    public function process(Request $request)
    {
        $this->validate($request, [
           'resume_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        if($this->resumeProcessor())
        {
            //$this->admission->save();
            return redirect()->route('resumes.show', $this->resume->reference_code)->with('success','Action performed successfully.');
        }

    }

    public function toggle(Resume $resume)
    {
        if ($resume->published == 1) {
            $resume->published = 0;
            $feedback = 'Resume Unpublished, Your details will not show up in our database search';
        } else {
            $resume->published = 1;
            $feedback = 'Your Resume is back online, Employers can find and contact you when they run a database search';
        }
        if ( ! $resume->save()) {
            return redirect()->back()->with('error', 'Could not update resume');
        }
        return redirect()->back()->with('success', $feedback);
    }


    public function status($status)
    {
        $totalresumes = $this->stats();
        $resumes = Resume::with('Profile', 'Education', 'Profile.Person')->whereStatus($status)->get();
        return view('humanresources::resumes.manage', compact('resumes', 'totalresumes'));
    }

    public function mapspecialties(Request $request)
    {
        $this->validate($request, [
            'resume_id' => 'required',
            'specialties' => 'required'
        ]);
        $this->resume = Resume::findOrFail($request->resume_id);
        if(isset($request->specialties))
        {
            $this->resume->Specializations()->sync($request->specialties);
        }
        return redirect()->back()->withSuccess('Resume Specialization Updated successfully');
    }

    public function detachspecialties(Request $request)
    {
        $this->validate($request, [
            'resume_id' => 'required',
            'specialization_id' => 'required'
        ]);
        $this->resume = Resume::findOrFail($request->resume_id);
        $this->resume->specializations()->detach($request->specialization_id);
        return redirect()->back()->withSuccess('Specialization Detached Successfully');
    }

    public function print(Resume $resume)
    {
        // $resume = Resume::where('profile_id', $profile->id)->first();
        return view('humanresources::resumes.resume', compact('resume'));
    }

    public function index()
    {
        //
        return view('humanresources::resumes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $profile = Auth::user()->Profile;
        if(Resume::whereProfileId($profile->id)->exists())
        {
            $resume = $profile->resume;
            return redirect()->route('resumes.show',compact('resume'))->with('success','Kindly update and submit for approval.');
        }
        $designations = $profile->Role->department->designations->pluck('job_role', 'id');
        $states = State::all()->pluck("state_name", "id");
        $employmentTypes = $this->allEmploymentTypes()->pluck("employment_type", "id");
        $visibilities = $this->visibilities;
        return view('humanresources::resumes.create', compact('designations', 'visibilities', 'profile', 'states', 'employmentTypes'));
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
            'career_objective' => 'required',
            'profile_id' => 'required',
            'designation_id' => 'required',
            'employment_type_id' => 'required',
            // 'availability' => 'required'
        ]);
        $this->data = $request->all();
        if($this->saveResume())
        {
            $this->saveAlert();
            if(isset($request->specializations))
            {
                $this->resume->Specializations()->sync($request->specializations);
            }
            return redirect()->route('resumes.show', $this->resume->reference_code)->with('success','resume has been created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        $contactTypes = ContactType::all()->pluck("contact_type");
        $contactTags = $this->contactTags;
        $addressPrefix = $this->addressPrefix;
        $paymentCycles = $this->paymentCycles;
        $states = State::all()->pluck("state_name", "id");
        $socialPlatforms = SocialPlatform::all()->pluck("platform_name", "id");
        $countries = Country::pluck('country_name', 'country_code')->all();
        $qualifications = Qualification::pluck('label', 'id')->all();
        $designations = $resume->profile->Role->department->designations->pluck('job_role', 'id');
        $specializations = $this->allSpecializations()->pluck("specialty", "id");
        $allprograms = Program::degrees()->pluck("label", "id");
        $employmentTypes = $this->allEmploymentTypes();
        return view('humanresources::resumes.show',
            compact('resume', 'allprograms', 'employmentTypes', 'socialPlatforms', 'countries',  'contactTypes', 'addressPrefix', 'contactTags', 'designations' , 'qualifications', 'states', 'paymentCycles', 'specializations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        //
        $visibilities = $this->visibilities;
        $designations = $resume->profile->Role->department->designations->pluck('job_role', 'id');;

        return view('humanresources::resumes.edit', compact('resume', 'designations', 'visibilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {
        //
        $this->validate($request, [
           //'qualification' => 'required',
            'designation_id' => 'required',
            'career_objective' => 'required'
        ]);

        $this->data = $request->all();
        // if($resume->update($request->all()))
        // {
        //     $this->resumeProcessor();
        //     return redirect()->route('resumes.show', $this->resume->id)->with('info','Resume Updated Successfully, awaiting approval to publish.');
        // }
        if($resume->update($request->all()))
        {
            if($resume->status == 'Approved')
            {
                $this->resume_id = $resume->id;
                $this->status = 'Moderation';
                $this->resumeProcessor();
            }
            return redirect()->route('resumes.show', $resume->reference_code)->with('success','Resume Updated Successfully, awaiting approval to publish.');
        }
        return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        //
        $resume->delete();
        return redirect()->back()
                        ->with('success','Resume deleted successfully');
    }
}
