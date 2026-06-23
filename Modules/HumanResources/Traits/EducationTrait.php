<?php

namespace  Modules\HumanResources\Traits;

use Modules\HumanResources\Entities\Education;
use Modules\CurriculumManagement\Entities\Course;
use Session;
use Carbon\carbon;
//use App\Traits\ProfileTrait;
use Modules\ClientManagement\Traits\OrganizationTrait;

trait EducationTrait {
    use OrganizationTrait;

    public function makeCourse()
    {      
        return Course::firstOrCreate(
            [
                'title_name' =>  ucfirst(!empty($this->data['title_name']) ? $this->data['title_name'] : $this->title_name)
            ],
            [
                'published' => !empty($this->data['published']) ? $this->data['published'] : '0'
            ]
        ); 
    }
    public function saveEducation()
    {
       if(isset($this->data['title_name']))
       {
        $this->data['course_id'] = $this->makeCourse()->id;
       }
        $this->education = new Education;   
        $this->education->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile->id;
        $this->education->course_id = !empty($this->data['course_id']) ? $this->data['course_id'] : NULL ;
        $this->education->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->makeOrganization()->id ;
        $this->education->qualification_id = $this->data['qualification_id'];
        $this->education->started_at = $this->data['started_at'];
        $this->education->completed_at = !empty($this->data['completed_at']) ? $this->data['completed_at'] : NULL ;       
        $this->education->cgpa = !empty($this->data['cgpa']) ? $this->data['cgpa'] : NULL;
        if( ! $this->education->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }        
       return $this->education;
    }

    public function saveCertification()
    {
        $this->certification = new Certification;   
        if($this->data['validity'] >0)
        {
            
            $this->data['expire_at'] = Carbon::now()->addYears($this->data['validity']);
        }
        $this->certification->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : Auth::user()->profile_id;
        $this->certification->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->makeOrganization()->id ;
        $this->certification->reference_code = $this->data['reference_code'];
        $this->certification->title_name = $this->data['title_name'];
        $this->certification->obtained_at = $this->data['obtained_at'];
        $this->certification->expire_at = !empty($this->data['expire_at']) ? $this->data['expire_at'] : NULL ;       
        $this->certification->note = !empty($this->data['note']) ? $this->data['note'] : NULL;
        if( ! $this->certification->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }        
       return $this->certification;
    }

    public function getprofileEducation($profile_id)
    {
        return Education::with('Qualification', 'Organization')->whereProfileId($profile_id)->get();
    }
    public function getprofileCertification($profile_id)
    {
        return Certification::with('Organization')->whereProfileId($profile_id)->get();
    }

    

}
