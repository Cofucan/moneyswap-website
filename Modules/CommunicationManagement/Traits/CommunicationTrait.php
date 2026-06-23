<?php

namespace Modules\CommunicationManagement\Traits;

use Illuminate\Http\Request;
use Modules\CommunicationManagement\Entities\Communication;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\CommunicationManagement\Entities\Profile;
use Modules\ClientManagement\Entities\Client;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Auth;
use Carbon\Carbon;
use Session;
use File;

trait CommunicationTrait {
    use ProfileTrait;


    public function saveCommunication()
    {

        $this->communication = new Communication;
        $this->communication->enrolment_id = !empty($this->data['enrolment_id']) ? $this->data['enrolment_id'] : $this->enrolment_id;
        // $this->communication->academic_term_id = !empty($this->data['academic_term_id']) ? $this->data['academic_term_id'] : $this->academic_term_id;
        // $this->communication->school_id = $this->data['school_id'];
        $this->communication->activity_type = $this->data['activity_type'];
        $this->communication->subject = !empty($this->data['subject']) ? $this->data['subject'] : '';
        // $this->communication->sent_at = !empty($this->data['sent_at']) ? $this->data['sent_at'] : Carbon::now()->addDay(7);
        $this->communication->sent_at = !empty($this->data['sent_at']) ? $this->data['sent_at'] : '';
        $this->communication->details = !empty($this->data['details']) ? $this->data['details'] : '';
        $this->communication->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        if(!$this->communication->save())
        {
            return redirect()->back()->withInput()->withErrors('Error creating communication');
        }
        return $this->communication;
    }

    public function client(Client $client)
    {
        //
        $communications = Communication::with('Client', 'AcademicTerm')->where('pupil_id', $client->id)->get();
        return view ('communications.index', compact('communications', 'client'));
    }

    public function SchoolVacancies()
    {
         $communication = communication::userinvoices()->paginate(5);
         //$communication = communication::paginate(5);
         return view('communication.userinvoices', compact('communication'));
    }

    public function communication($slug)
    {
        $communication = Communication::where('slug', $slug)->first();
        return view('communications.communication', compact('communication'));
    }

    public function details($slug)
    {
        $communication = Communication::where('slug', $slug)->first();
        abort_if(!$communication, 404);
        //$communication->increment('page_views');
        return view('communications.communication', compact('communication'));
    }

    public function processCommunication()
    {
        if(!isset($this->communication)){
            $communication_id = !empty($this->data['communication_id']) ? $this->data['communication_id'] : $this->communication_id;
            $this->communication = Communication::findorFail($communication_id);
        }

        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;

        switch ($status){
            case "Scheduled":

            $this->destination = 'communications.show';
            //send notification to parent
            break;
            case "Accepted":

            $this->invoice = new Invoice;
            if($this->saveInvoice()){
                foreach($this->communication->BillItems as $this->billItem)
                {
                    $this->InvoiceItem = new InvoiceItem;
                    $this->saveInvoiceItem();
                }
                $this->communication->status = 'Accepted';
                $this->communication->save();
                //$toUser->notify(new NewMessage($fromUser));
                    //Auth::User()->notify(new NewInvoice());
                $this->destination = 'communications.show';
            }
            break;
            case "Rejected":
               //
               //$this->registration = Registration::findorFail($this->admission->registration_id);


                    $this->destination = 'admissions.declined';

            break;

            }
            if($this->communication->save()){

                return $this->destination;
            }
    }

    /* $clients = Client::with('latestBill')->get();
    foreach ($authors as $author) {
        echo $author->name . ': ' . $author->latestBook->title;
    } */
    public function processAnnouncement()
    {
       if(!isset($this->announcement))
        {
            $this->announcement = Announcement::findorFail(!empty($this->data['announcement_id']) ? $this->data['announcement_id'] : $this->announcement_id);
        }
      /*   if($this->announcement->publish_date < Carbon::today())
        {
            return redirect()->back()->with('Error', 'status cannot be updated');
        }    */
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        $this->announcement->status= $status;
        switch ($status){
            case "Approved":
            //$response = $this->setupLive();
            $this->announcement->publish_date = Carbon::today();
            $this->announcement->published = true;

            //send notification to recipients
            break;
            case "Cancelled":

            break;
            case "Suspended":

            break;

            }
            return $this->announcement->save();
    }

    public function allstatus()
    {
        return [
            'Draft' => 'Draft',
            'Scheduled' => 'Schedule',
            'Publish' => 'Publish Now',
        ];
    }

}
