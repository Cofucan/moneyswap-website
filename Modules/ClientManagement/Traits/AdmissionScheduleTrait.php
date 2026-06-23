<?php

namespace App\Traits;

use App\Models\AdmissionSchedule;
use Session;
use Carbon\carbon;
use PDF;

trait AdmissionScheduleTrait {
     
    public function saveAdmissionSchedule()
    {
        $this->admissionschedule = new AdmissionSchedule;        
        $this->admissionschedule->academic_term_id = $this->data['academic_term_id'];      
        $this->admissionschedule->label = $this->data['label'];
        $this->admissionschedule->available_at = !empty($this->data['available_at']) ? $this->data['available_at'] : Carbon::today();
        $this->admissionschedule->close_at = !empty($this->data['close_at']) ? $this->data['close_at'] : Carbon::now()->addMonth();
        //$this->admissionschedule->rate = !empty($this->data['rate']) ? $this->data['rate'] : '0';
        //$this->admissionschedule->currency = !empty($this->data['currency']) ? $this->data['currency'] : 'NGN';
        $this->admissionschedule->acceptance_deadline = $this->data['acceptance_deadline'];
        $this->admissionschedule->published = !empty($this->data['published']) ? $this->data['published'] : 0;
        $this->admissionschedule->remarks = !empty($this->data['remarks']) ? $this->data['remarks'] : '';
        $this->admissionschedule->status = !empty($this->data['status']) ? $this->data['status'] : 'Draft';
        $this->admissionschedule->user_id = Auth::id();
        if ( !$this->admissionschedule->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->admissionschedule;        
    }
    public function saveAdmissionSchedule2()
    {
        $this->academicterm = AcademicTerm::findOrFail($this->data['academic_term_id']);
        $this->admissionschedule = new AdmissionSchedule;
        $this->admissionschedule->academic_term_id = $this->data['academic_term_id'];
        $this->admissionschedule->school_id = $this->data['school_id'];
        $this->admissionschedule->label = !empty($this->data['label']) ? $this->data['label'] : $this->generateScheduleLabel(); ;
        $this->admissionschedule->open_at = !empty($this->data['open_at']) ? $this->data['open_at'] : Carbon::today();
        $this->admissionschedule->close_at = !empty($this->data['close_at']) ? $this->data['close_at'] : Carbon::now()->addMonth();
        //$this->admissionschedule->rate = !empty($this->data['rate']) ? $this->data['rate'] : '0';
        //$this->admissionschedule->currency = !empty($this->data['currency']) ? $this->data['currency'] : 'NGN';
        $this->admissionschedule->availability = !empty($this->data['availability']) ? $this->data['availability'] : 0;
        $this->admissionschedule->status = !empty($this->data['status']) ? $this->data['status'] : 'Draft';
        if ( !$this->admissionschedule->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->admissionschedule;
    }
    public function saveAdmissionRequirement()
    {
            $this->admissiongrade = AdmissionGrade::findorFail($this->data['admission_grade_id']);
            $this->admissionrequirement->label =  !empty($this->data['label']) ? $this->data['label'] :Null;
            $this->admissionrequirement->overview =  $this->data['overview'];
            if ( ! $this->admissiongrade->AdmissionRequirements()->save($this->admissionrequirement)) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            return $this->admissionrequirement;
    
    }
    
    public function saveAdmissionDocument()
    {
        return AdmissionDocument::firstOrCreate(
            [
                'document_type_id' => !empty($this->data['document_type_id']) ? $this->data['document_type_id'] : $this->document_type_id,
                'admission_grade_id' => !empty($this->data['admission_grade_id']) ? $this->data['admission_grade_id'] : $this->admission_grade_id
            ],
            [
                'validate' => !empty($this->data['validate']) ? $this->data['validate'] : '1'
            ]
        );
    
    }

    public function generateScheduleLabel()
    {
        return $this->academicterm->academic_term. " " ."Admission";
    }
    
    public function saveAdmissionGrade()
    {
        return AdmissionGrade::firstOrCreate(
            [
                'school_id' => !empty($this->data['school_id']) ? $this->data['school_id'] : Auth::user()->profile->organization->school->id,
                'grade_id' => !empty($this->data['grade_id']) ? $this->data['grade_id'] : $this->grade_id
            ],
            [
                'min_age' => !empty($this->data['min_age']) ? $this->data['min_age'] : NULL,
                // 'remarks' => !empty($this->data['remarks']) ? $this->data['remarks'] : NULL,
                'published' => !empty($this->data['published']) ? $this->data['published'] : '1'
            ]
        );
    
    }    
    

}
