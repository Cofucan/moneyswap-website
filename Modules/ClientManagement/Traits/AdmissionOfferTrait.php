<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\AdmissionOffer;
use App\Models\Registration;
use Modules\ClientManagement\Entities\Client;
use Modules\CalendarManagement\Entities\AcademicTerm;
use App\Traits\EligibleTrait;
use File;
use Session;
use Carbon\carbon;
use PDF;
trait AdmissionOfferTrait {
    use EligibleTrait;

    public function saveAdmissionOffer()
    {
            $this->admissionoffer = new AdmissionOffer;
            if(isset($this->data['registration_id']) || isset($this->registration_id)){
                $this->registration_id = !empty($this->data['registration_id']) ? $this->data['registration_id'] : $this->registration_id;
                $this->registration = Registration::findorFail($this->registration_id);

                $this->admissionoffer->registration_id = !empty($this->data['registration_id']) ? $this->data['registration_id'] : $this->registration_id;
                $this->person = $this->registration->person;
                $this->academic_term_id = $this->registration->academic_term_id;
                //$this->admission_year = date("Y", strtotime($this->registration->update_at)); // this
            }
            $this->admissionoffer->academic_term_id = !empty($this->data['academic_term_id']) ? $this->data['academic_term_id'] : $this->academic_term_id;
            $this->admissionoffer->person_id = !empty($this->data['person_id']) ? $this->data['person_id'] : $this->person->id;
            $this->admissionoffer->offer_number = !empty($this->data['offer_number']) ? $this->data['offer_number'] : NULL;
        $this->admissionoffer->status = !empty($this->data['status']) ? $this->data['status'] : 'Recommended';
        $this->admissionoffer->level_id = !empty($this->data['level_id']) ? $this->data['level_id'] : $this->registration->level_id;
        $this->admissionoffer->group_id = !empty($this->data['group_id']) ? $this->data['group_id'] : $this->registration->group_id;
        $this->admissionoffer->client_category_id = !empty($this->data['client_category_id']) ? $this->data['client_category_id'] : $this->registration->client_category_id;
        $this->admissionoffer->remarks = !empty($this->data['remarks']) ? $this->data['remarks'] : '';

        if ( ! $this->admissionoffer->save()) {
            return redirect()->back()->withErrors('Error Saving record');
        }
        return $this->admissionoffer;
    }

    public function letter(AdmissionOffer $admissionoffer)
    {
        // $pdf = PDF::loadView('admissionoffers.admissionletter', compact('admissionoffer'));
        // return $pdf->download('admissionletter.pdf');
        return view('admissionoffers.admissionletter', compact('admissionoffer'));
    }

    public function offer(AdmissionOffer $admissionoffer)
    {
        // $pdf = PDF::loadView('admissionoffers.offer', compact('admissionoffer'));
        // return $pdf->download('admissionoffer.pdf');
        return view('admissionoffers.offer', compact('admissionoffer'));
    }

    public function getrequirementlist(Request $request)
    {
        $section = $request->section;
        $admission_requirements = AdmissionRequirement::where('section_id', $section)->pluck("requirement","id");
        return response()->json($admission_requirements);
    }

    public function processAdmissionOffer()
    {
        $admission_offer_id = !empty($this->data['admission_offer_id']) ? $this->data['admission_offer_id'] : $this->admissionoffer->id;
        $this->admissionoffer = AdmissionOffer::findorFail($admission_offer_id);
        if(is_null($this->admissionoffer->registration_id))
        {
            return redirect()->back()->with('Error', 'This AdmissionOffer details cannot be updated through this platform');
        }
        $this->registration = Registration::findorFail($this->admissionoffer->registration_id);
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        $this->registration->status= $status;
        $this->admissionoffer->status= $status;
        switch ($status){
            case "Offered":
            $this->admissionoffer->feedback_deadline = Carbon::today()->addMonth();
            $this->admissionoffer->sent_at = Carbon::now();
           //send notification to applicant
            $this->destination = 'admissionoffers.index';
            break;
            case "Accepted":

            $this->enrolment_status = 'New';
            $this->orphan_id = $this->registration->orphan_id;
            $this->academic_term_id = $this->admissionoffer->academic_term_id;
            $this->client_category_id = $this->admissionoffer->client_category_id;
            $this->level_id = $this->admissionoffer->level_id;
            $this->group_id = $this->admissionoffer->group_id;
            $this->section_id = $this->admissionoffer->Level->section_id;
            $this->data['status'] = 'Scheduled';
            $this->data['due_date'] = $this->admissionoffer->AcademicTerm->payment_deadline;
            if($this->generateRollNumber()){
                $this->admissionoffer->accepted_at = Carbon::now();
                $this->admissionoffer->offer_number = $this->offer_number;
                $this->destination = 'admissionoffers.letter';
                $this->saveEligible();
            }
            break;
            case "Declined":
               //
               //$this->registration = Registration::findorFail($this->admissionoffer->registration_id);
                    $this->destination = 'admissionoffers.declined';

            break;
            /* case "enrol":
            $client = Client::where('admission_offer_id', $this->admissionoffer->id);
            //$this->studentenrolment = new StudentEnrolment;
            if ( ! $this->enrolStudent()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            //attach room to client

            break; */

            }
            if($this->admissionoffer->save()){
                $this->registration->save();
                return $this->destination;
            }
    }

public function generateRollNumber()
{
    $this->offer_number = !empty($this->data['offer_number']) ? $this->data['offer_number'] : AdmissionOffer::max('offer_number')+1;
    if(!isset($this->admissionoffer)){
        $admission_offer_id = !empty($this->data['admission_offer_id']) ? $this->data['admission_offer_id'] : $this->admission_offer_id;
        $this->admissionoffer = AdmissionOffer::findorFail($admission_offer_id);
    }
    $this->admission_year = date("Y", strtotime($this->admissionoffer->AcademicTerm->start_date));
    $this->client = Client::findOrFail($this->orphan_id);
    $this->client->student_code = 'SVIC/'.$this->admission_year.'/'.$this->offer_number;
    $this->client->group_id = $this->group_id;
    $this->client->client_category_id = $this->client_category_id;
    $this->client->level_id = $this->level_id;
    $this->client->admission_offer_id = $this->admissionoffer->id;
    return $this->client->save();

}


}
