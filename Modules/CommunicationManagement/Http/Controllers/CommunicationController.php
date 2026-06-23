<?php

namespace Modules\CommunicationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\CommunicationManagement\Entities\Communication;
use Modules\CommunicationManagement\Client\Client;
use Modules\CalendarManagement\Entities\ActivityType;
use Modules\CommunicationManagement\Traits\CommunicationTrait;
use Illuminate\Http\Request;
use Carbon\carbon;
use Auth;

class CommunicationController extends Controller
{
    use CommunicationTrait;
    public function __construct()
    {
        $this->activityTypes= ActivityType::where('published', true)->pluck("activity_type");
    }

    public function manage()
    {
        //
        $communications = Communication::with('Client', 'AcademicTerm')->get();
        return view ('communicationmanagement::communications.manage', compact('communications'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        //
        $communications = Communication::with('Client', 'AcademicTerm')->where('pupil_id', $client->id)->get();
        return view('communicationmanagement::communications.index', compact('communications', 'client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        //
        $activityTypes = $this->activityTypes;
        return view('communicationmanagement::communications.create', compact('activityTypes', 'client'));
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
            'subject' => 'required',
            'activity_type' => 'required',
            'details' => 'required',
            'enrolment_id' => 'required'
        ]);
        $this->data = $request->all();
        if($this->saveCommunication())
        {
            return redirect()->back()->with('success','communication has been created successfully');
            // return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function show(Communication $communication)
    {
        //
        return view('communicationmanagement::communications.show', compact('communication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function edit(Communication $communication)
    {
        //
        $activityTypes = $this->activityTypes;
        return view('communicationmanagement::communication.edit', compact('communication', 'activityTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Communication $communication)
    {
        //
        $this->validate($request, [
            'subject' => 'required',
            'activity_type' => 'required',
            'details' => 'required',
            'pupil_id' => 'required'
        ]);
        $data = $request->all();
        $this->communication_id = $communication->id;
        if ($request->hasFile('log_media')) {
            $this->log_media = $request->file('log_media');

        }
        if($this->saveCommunication())
        {
            return redirect()->route('communication.show', $this->communication->id)->with('success','communication Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Communication $communication)
    {
        //
        $communication->delete();
        return redirect()->back()
                        ->with('success','Bank deleted successfully');
    }
}
