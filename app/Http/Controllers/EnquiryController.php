<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\RealtyInventory;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Mail\EnquirySubmitted;
use Auth;
use Session;
use Mail;

class EnquiryController extends Controller
{
    public function saveEnquiry()
    {       
        $this->enquiry->enquiry_body = $this->data['enquiry_body'];
        $this->enquiry->contact_name = $this->data['contact_name'];
        $this->enquiry->email = $this->data['email'];
        if(!isset($this->data['country_code'])){
            $this->enquiry->telephone ='+234'.substr($this->data['telephone'],-10);
        }else{
            $this->enquiry->telephone = $data['country_code'].substr($this->data['telephone'],-10);
        }
        
        switch ($this->data['enquiryable_type']){
        case "realtyinventory":
            $realtyinventory = RealtyInventory::find($this->data['enquiryable_id']);            
            if(!isset($this->data['enquiry_title'])){
                $this->enquiry->enquiry_title = 'Online Enquiry for '. $realtyinventory->inventory_name;
            }
            $realtyinventory->Enquiries()->save($this->enquiry);
            break;
        case "estate":
            $estate = Estate::find($this->data['enquiryable_id']);
            if(!isset($this->data['enquiry_title'])){
                $this->enquiry->enquiry_title = 'Online Enquiry for '. $estate->estate_name;
            }
            $estate->Enquiries()->save($this->enquiry);
            break;
        case "event":
            $event = Event::find($this->data['enquiryable_id']);
            if(!isset($this->data['enquiry_title'])){
                $this->enquiry->enquiry_title = 'Online Enquiry for '. $event->inventory_name;
            }
            $event->Enquiries()->save($this->enquiry);
            break;
        case "lot":
            $lot = Lot::find($this->data['enquiryable_id']);
            if(!isset($this->data['enquiry_title'])){
                $this->enquiry->enquiry_title = 'Online Enquiry for '. $lot->lot_name;
            }
            $lot->Enquiries()->save($this->enquiry);
            break;
        case "project":
        $project = Project::find($this->data['enquiryable_id']);
        if(!isset($this->data['enquiry_title'])){
            $this->enquiry->enquiry_title = 'Online Enquiry for '. $project->project_name;
        }
        $project->Enquiries()->save($this->enquiry);
        break;
        default:
        if(!isset($this->data['enquiry_title'])){
            $this->enquiry->enquiry_title = 'Online Enquiry From '. $this->enquiry->contact_name;
        }
        $this->enquiry->save();
        }
        return $this->enquiry;
    }

    public function manage()
    {
    $enquiries = Enquiry::where('email', Auth::user()->email);
    return view('enquiries.manage', compact('enquiries'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enquiries = Enquiry::where('status','New')->orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
            });
            return view('enquiries.index', compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->data = $request->all();
        $this->enquiry = new Enquiry;
        $this->enquiry->enquiry_device_ip = $request->getClientIp();
        if($this->saveEnquiry())
        {
           //send notification
           Mail::to($this->enquiry->email)
               ->cc($request->portal_email)
                //->bcc($evenMoreUsers)
                ->send(new EnquirySubmitted($this->enquiry));
            return redirect()->back()->with('success','Thank you for contacting us. A service rep will respond to your query as soon as possible.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
        return view('enquiries.show',compact('enquiry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
        $feature = Feature::find($feature->id);
        $feature->feature_name = $request->feature_name;
        $feature->feature_description = $request->feature_description;
        $feature->save();
        return response()->json($feature);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        //
        $enquiry->delete();
        return response()->json($enquiry);
    }
}
