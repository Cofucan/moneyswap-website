<?php

namespace Modules\HumanResources\Traits;

use Modules\HumanResources\Entities\Resume;
use Modules\HumanResources\Entities\Vacancy;
use Modules\HumanResources\Entities\Education;
use Modules\HumanResources\Entities\Employment;
use Modules\ProfileManagement\Entities\Profile;
use Auth;
use Carbon\Carbon;
use Session;
use File;
use DB;
use Modules\HumanResources\Traits\EducationTrait;
use Modules\HumanResources\Traits\EmploymentTrait;
use Modules\HumanResources\Traits\ApplicationTrait;
// use App\Traits\AlertTrait;
use Modules\ProfileManagement\Traits\ProfileTrait;

trait ResumeTrait {
use ProfileTrait;
use EducationTrait;
use EmploymentTrait;
// use AlertTrait;
use ApplicationTrait;

    public function saveResume()
    {
        $this->resume =  new Resume;
        $this->resume->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : Auth::user()->profile_id;
        $this->resume->career_objective = !empty($this->data['career_objective']) ? $this->data['career_objective'] : NULL;
        $this->resume->designation_id = !empty($this->data['designation_id']) ? $this->data['designation_id'] : $this->designation->id;
        $this->resume->employment_type_id = !empty($this->data['employment_type_id']) ? $this->data['employment_type_id'] : $this->employmenttype->id;
        $this->resume->city_id = !empty($this->data['city_id']) ? $this->data['city_id'] : $this->city->id;
        // $this->resume->education_id = $this->data['education_id'];
        //$this->resume->experience_years = !empty($this->data['experience_years']) ? $this->data['experience_years'] : $this->resume->experience_years;
        if ( !$this->resume->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        // generate alert
        return $this->resume;
    }

    public function recommendedjobs($profile)
    {

        $vacancies = Vacancy::with('School')->wherePublished('1')
                    ->where('designation_id', $profile->Resume->designation_id)
                    // ->where('city_id', $profile->Resume->city_id)
                    ->orderBy('close_at', 'Desc')->get();
         return $vacancies;
    }

 /*    public function saveSpecialization()
    {
        $this->specialization = Specialization::updateOrCreate(
            [
                'subject_id' => !empty($this->data['subject_id']) ? $this->data['subject_id'] : $this->subject->id,
                'profile_id' => !empty($this->data['profile_id']) ? $this->data['profile_id'] : Session::get('profile_id')
            ],
            [
                'experience_years' => !empty($this->data['experience_years']) ? $this->data['experience_years'] : 1,
                'proficiency' => !empty($this->data['proficiency']) ? $this->data['proficiency'] : Null,
                'published' => !empty($this->data['published']) ? $this->data['published'] : '1'
            ]
        );
        return $this->city;
    } */

    public function addSpecialty()
    {
        if(!isset($this->resume) ){
            $this->resume = Resume::findOrFail(!empty($this->data['resume_id']) ? $this->data['resume_id'] : $this->resume_id);
        }

        return $this->resume->Specializations()->attach(!empty($this->specilization->id) ? $this->specilization->id : $this->data['specilization'],
            [
            'experience_years' => !empty($this->experience_years) ? $this->experience_years : $this->data['experience_years'],
            'published' => !empty($this->published) ? $this->published : true,
            ]);
        //return $this->profile;
    }

    public function getResumeId()
    {
        return Resume::updateOrCreate(
            [
                'profile_id' => !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile->id,
                'designation_id' => !empty($this->data['designation_id']) ? $this->data['designation_id'] : $this->designation->id
            ],
            [
                'education_id' =>!empty($this->data['education_id']) ? $this->data['education_id'] : $this->education->id,
                'visibility' =>!empty($this->data['visibility']) ? $this->data['visibility'] : 'Private',
                'published' =>!empty($this->data['published']) ? $this->data['published'] : '0'
            ]
        );
    }

    public function resume(Resume $resume)
    {
        return view('resumes.resume', compact('resume'));
    }

    public function profile(Profile $profile)
    {
        $resume = Resume::whereProfileId($profile->id)->first();
        return view('resumes.preview', compact('resume'));
    }

    public function preview(Resume $resume)
    {
        // $resume = Resume::where('profile_id', $profile->id)->first();
        return view('resumes.preview', compact('resume'));
    }

    public function resumeProcessor()
    {
        if(!isset($this->resume)){
            $this->resume = Resume::findorFail(!empty($this->data['resume_id']) ? $this->data['resume_id'] : $this->resume_id);
        }
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;

        switch ($status){
            case "Approved":
                //generate resume number
                // send account verification Email
                $this->resume->published_date = !empty($this->data['published_date']) ? $this->data['published_date'] : Carbon::today();
                $this->resume->published = true;
            break;
            case "Moderation":

            $this->msghead = 'success';
            $this->msgbody = 'Awaitng Approval';

            break;
            case "Rejected":

                $this->msghead = 'success';
                $this->msgbody = 'Resume Suspended';

            break;
            case "Suspended":

                $this->msghead = 'success';
                $this->msgbody = 'Resume Suspended';

            break;
            case "Banned":

            $this->msghead = 'warning';
            $this->msgbody = 'Resume Banned';
            break;

            }
            $this->resume->status = $status;
            if($this->resume->save()){
                Employment::where('profile_id', $this->resume->profile_id)
                ->update(['status' => $status]);
                Education::where('profile_id', $this->resume->profile_id)
                ->update(['status' => $status]);
                return $this->resume;
            }
    }

    public function visibilityStats()
    {
        return DB::table('resumes')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when visibility = 'Private' then 1 end) as private")
            ->selectRaw("count(case when visibility = 'Public' then 1 end) as public")
            ->selectRaw("count(case when visibility = 'Recruiter' then 1 end) as recruiter")
            ->first();
    }

    public function resumeStats()
    {
        return DB::table('resumes')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when status = 'Draft' then 1 end) as draft")
            ->selectRaw("count(case when status = 'WIP' then 1 end) as wip")
            ->selectRaw("count(case when status = 'Completed' then 1 end) as published")
            ->selectRaw("count(case when status = 'Published' then 1 end) as published")
            ->first();
    }

}
