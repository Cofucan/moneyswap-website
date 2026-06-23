<?php

namespace Modules\RegistrationManagement\Traits;

use Illuminate\Http\Request;

use Modules\ProfileManagement\Entities\Profile;
use Modules\RegistrationManagement\Entities\Registration;
use Modules\AdmissionManagement\Entities\Admission;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\Invoice;
use Modules\AdmissionManagement\Entities\AdmissionFee;
use Modules\SchoolManagement\Entities\Level;
use Modules\DocumentManagement\Entities\DocumentType;
use Modules\DocumentManagement\Entities\Document;
use Modules\RegistrationManagement\Entities\RegistrationDocument;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Modules\InvoiceManagement\Traits\InvoiceTrait;
use Modules\LocationManagement\Traits\AddressTrait;
use DB;
use File;
use Auth;
use Session;
use Carbon\carbon;
use Image;

trait RegistrationTrait {
    use AddressTrait;
    use InvoiceTrait;
   use ProfileTrait;

    public function saveRegistration()
    {
        if(!$this->saveProfile())
        {
            return redirect()->back()->with('Error', 'Could not create client profile at the moment');
        }
        $this->registration = new Registration;
        $this->registration->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile->id;
        $this->registration->admission_schedule_id = $this->data['admission_schedule_id'];
        $this->registration->admission_grade_id = $this->data['admission_grade_id'];
        $this->registration->current_grade_id = $this->data['current_grade_id'];
        $this->registration->client_category_id = $this->data['client_category_id'];
        $this->registration->stream_id = !empty($this->data['stream_id']) ? $this->data['stream_id'] : NULL;
        $this->registration->outlet_id = $this->data['outlet_id'];
            if(isset($this->avatar))
            {
                if( ! File::exists('images/people/registrations/')) {
                $registration_img = File::makeDirectory('images/people/registrations', 0777, true);
                }
                $filename = str_slug($this->person->name).'_'.time().'.'.$this->avatar->getClientOriginalExtension();
                $registration_photo = 'images/people/registrations/' . $filename;
                $this->registration->avatar = $registration_photo;
                Image::make($this->avatar)->fit('389', '439', function ($constraint) {
                        $constraint->upsize();
                    })->save($registration_photo);
            }
            if ( ! $this->registration->save()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            if(!$this->data['student_address'] == 'Existing')
            {
                $this->address_id = Auth::user()->Profile->DefaultAddress->first()->id;
                $this->registration->profile->Addresses()->attach(!empty($this->data['address_id']) ? $this->data['address_id'] : $this->address_id,
                [
                'address_type' => !empty($this->data['address_type']) ? $this->data['address_type'] : 'Default',
                'date_from' => !empty($this->data['date_from']) ? $this->data['date_from'] : Carbon::today(),
                'published' => !empty($this->data['published']) ? $this->data['published'] : true
                ]);

            }else{
                 $this->saveAddress();
            }
            // if(!empty($this->data['income']))
            // {
            //     $this->saveSponsor();
            // }
        $this->data['invoiceable_type'] = 'registration';
        if($this->saveInvoice())
        {
            return $this->registration;
        }
        $this->registration->delete();
        return redirect()->back()->withErrors('Registration form created without an invoice');
    }

    public function slip(Registration $registration)
    {
        return view('registrations.slip', compact('registration'));
    }

public function preview(Registration $registration)
{
    $registrationStatuses = $this->registrationStatuses;
   /*  if($registration->status == 'Draft')
    {
        return redirect()->route('registrations.pay', $registration->id)->with('info','Kindly Make revenue to complete your revenue.');
    } */
    $documentTypes = $this->pendingdocuments($registration);
    if(count($documentTypes) >0 )
    {
        return view('registrations.adddocuments', compact('registration', 'documentTypes'));
    }
    return view('registrations.preview', compact('registration', 'registrationStatuses'));
}

public function requiredDocuments($grade_id)
{
    $this->grade_id = $grade_id;
    $documentTypes = DocumentType::whereHas('AdmissionDocuments', function($q){
        $q->where('grade_id', $this->grade_id)->where('published', true);
    })->get();
    return $documentTypes;
}
public function pendingdocuments($registration)
{
    $this->registration = $registration;
    $uploads = Document::wherePersonId($this->registration->person_id)->pluck("document_type_id");
    $documentTypes = DocumentType::whereHas('AdmissionDocuments', function($q){
        $q->where('grade_id', $this->registration->grade_id)->where('published', true);
    })->whereNotIn('id', $uploads)->get();
    return $documentTypes;
}

    public function processRegistration()
    {
        $registration_id = !empty($this->data['registration_id']) ? $this->data['registration_id'] : $this->registration_id;
        $this->registration = Registration::findorFail($registration_id);
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        switch ($status){
            case "Submitted":
            $this->registration->submitted_at = Carbon::now();
            $reg_no = Registration::where('status', 'Submitted')->count();
             if(is_null($reg_no) || $reg_no==0){
                 $reg_no = 0;
             }
             $reg_no = ++$reg_no;
            $this->registration->registration_code = 'SVIC/REG/'.date('Y').'/'.$reg_no;
            $this->feedbackHead = 'success';
            $this->feedbackBody = 'You Application has been submitted successfully.';
            $this->destination = 'registrations.slip';
            //send notification to applicant

            break;
            case "Paid":
             $this->registration->registration_code = $this->generateFormNumber();
             $this->registration->status = 'Paid';
             if($this->registration->save())
             {
                return redirect()->back()->with('success','Application Revenue Updated successfully.');
             }

            $this->feedbackHead = 'success';
            $this->feedbackBody = 'Application Fee is fully paid.';
            $this->destination = 'registrations.documentation';
            //send notification to applicant

            break;
            case "Approved":
            //$this->registration->status = $this->status;
            $this->destination = 'registrations.applied';
            $this->feedbackHead = 'success';
            $this->feedbackBody = 'The Application with registration code:'.$this->registration->registration_code . ' was approved successfully';
            //return $this->destination;
            //$this->registration->date_submitted = Carbon::now();
            //send test notification to applicant
            break;
            case "Rejected":
            $this->destination = 'registrations.preview';
            return $this->destination;
            break;
            case "Offered":
                $this->admission->feedback_deadline = Carbon::today()->addMonth();
                $this->admission->offer_date = Carbon::now();
               //send notification to applicant
                $this->destination = 'admissions.index';
                break;
            }
            $this->registration->status = $status;
            return $this->registration->save();
            return $this->destination;
    }

    public function getcandidatelevels(Request $request)
    {
        $this->academicterm = $request->academicterm;
         $levels = Level::whereHas('Registrations', function($q){
            $q->where('academic_term_id', $this->academicterm)->where('status', 'Approved');
        })->pluck("label", "id");
        return response()->json($levels);
    }

    public function registrationStats()
    {
        return DB::table('registrations')
                    ->selectRaw('count(*) as total')
                    ->selectRaw("count(case when status = 'Submitted' then 1 end) as submitted")
                    ->selectRaw("count(case when status = 'Shortlisted' then 1 end) as shortlisted")
                    ->selectRaw("count(case when status = 'Offered' then 1 end) as offered")
                    ->selectRaw("count(case when status = 'Accepted' then 1 end) as accepted")
                    ->selectRaw("count(case when status = 'Enrolled' then 1 end) as enrolled")
                    ->first();
    }
    public function generateFormNumber()
    {
        $this->registration->form_number = !empty($this->registration->form_number) ? $this->registration->form_number : Registration::max('form_number')+1;
        return "SVIC/".date('Y').'/'.str_pad($this->registration->form_number,5,'0', str_PAD_LEFT);
    }
}
