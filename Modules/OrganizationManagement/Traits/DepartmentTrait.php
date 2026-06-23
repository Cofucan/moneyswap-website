<?php

namespace  Modules\OrganizationManagement\Traits;
//use App\Traits\OrganizationTrait;
use Modules\OrganizationManagement\Entities\Department;
use Modules\EmploymentManagement\Entities\Designation;
use Modules\SchoolManagement\Entities\Program;
use Modules\EmploymentManagement\Entities\Skill;
use Modules\OrganizationManagement\Entities\Division;
use Modules\EmploymentManagement\Entities\Specialization;
use Carbon\Carbon;

trait DepartmentTrait {

    //use OrganizationTrait;
    public function saveDepartment()
    {
        $this->department = new Department;
        $this->department->label = $this->data['label'];
        $this->department->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $this->department->icon = !empty($this->data['icon']) ? $this->data['icon'] : Null;
        $this->department->practitioner = !empty($this->data['practitioner']) ? $this->data['practitioner'] : $this->getSectorNoun();
        $this->department->is_default = !empty($this->data['is_default']) ? $this->data['is_default'] : 0;
        $this->department->published = !empty($this->data['published']) ? $this->data['published'] : 1;
        if ( !$this->department->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->department;
    }
    public function saveDivision()
    {
        $this->division = new Division;
        $this->division->department_id = !empty($this->data['department_id']) ? $this->data['department_id'] : $this->getIndustryId();
        $this->division->label = $this->data['label'];
        $this->division->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $this->division->icon = !empty($this->data['icon']) ? $this->data['icon'] : Null;
        $this->division->is_default = !empty($this->data['is_default']) ? $this->data['is_default'] : 0;
        $this->division->published = !empty($this->data['published']) ? $this->data['published'] : 1;
        if ( !$this->division->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->division;
    }

    public function saveDuty()
    {
        $this->duty = new Duty;
        $this->duty->label = $this->data['label'];
        $this->duty->designation_id = $this->data['designation_id'];
        $this->duty->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        // $this->duty->icon = !empty($this->data['icon']) ? $this->data['icon'] : Null;
        $this->duty->sequence_number = !empty($this->data['sequence_number']) ? $this->data['sequence_number'] : 0;
        $this->duty->published = !empty($this->data['published']) ? $this->data['published'] : 1;
        if ( !$this->duty->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->duty;
    }
    public function saveDesignation()
    {
        $this->designation = new Designation;
        $this->designation->division_id = !empty($this->data['division_id']) ? $this->data['division_id'] : $this->division_id;
        $this->designation->job_role = $this->data['job_role'];
        $this->designation->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $this->designation->requirements = !empty($this->data['requirements']) ? $this->data['requirements'] : NULL;
        $this->designation->work_condition = !empty($this->data['work_condition']) ? $this->data['work_condition'] : NULL;
        $this->designation->parent_id = !empty($this->data['parent_id']) ? $this->data['parent_id'] : '0';
        $this->designation->published = !empty($this->data['published']) ? $this->data['published'] : true;
        if ( ! $this->designation->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->designation;
    }
    public function makeDesignation()
    {
        return Designation::firstOrCreate(
            ['job_role' =>  ucfirst(!empty($this->data['job_role']) ? $this->data['job_role'] : $this->row['job_role'])],
            [
                'published' => false,
                'division_id' => !empty($this->data['division_id']) ? $this->data['division_id'] : NULL,
                'overview' => !empty($this->data['overview']) ? $this->data['overview'] : NULL
            ]
        );
    }
    public function departmentInfo($slug)
    {
        return Department::where('slug',$slug)->first();
    }

    public function getDesignationDetails($slug)
    {
        return Designation::where('slug',$slug)->first();
    }


    public function getAllDivision()
    {
        return Division::active()->get();
    }
    public function allSpecializations()
    {
        return Specialization::all();
    }
    public function allSkills()
    {
        return Skill::all();
    }
    public function allPhases()
    {
        return Program::all();
    }
    public function allDesignations()
    {
        return Designation::all();
    }
    public function divisionDesignations($department_id)
    {
        return Designation::whereDivisionId($department_id)->get();
    }




    public function getDefaultDivisionId()
    {
        $division = Division::where('is_default', true)->first();
        return $division->id;
    }




}
