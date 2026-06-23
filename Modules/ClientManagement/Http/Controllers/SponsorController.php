<?php

namespace Modules\RegistrationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\RegistrationManagement\Entities\Agent;
use Illuminate\Http\Request;
use Modules\ProfileManagement\Traits\ProfileTrait;
class RelativeController extends Controller
{
    use ProfileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $screening_types = $this->screening_types;
        $admissionschedules= admissionschedule::where('status', '<>', 'Draft')->get();
        $programs = Program::where('published', true)->pluck("label", "id");
        return view('registrationmanagement::agents.create', compact('screening_types','admissionschedules', 'programs'));

    }

    public function manage()
    {
        //
        $agents = Agent::available()->get();
        return view('registrationmanagement::agents.manage', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'required',
            'person_id' => 'required',
            'relationship_id' => 'required',
            'occupation' => 'required',
            'email' => 'required',
            'telephone' => 'required'
        ]);

        $this->data = $request->all();
        if($this->saveSponsor())
        {
            return redirect()->route('agents.show', $this->sponsor->id)->with('success','Sceening Scheduled successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $sponsor)
    {
        return view('registrationmanagement::agents.show',compact('sponsor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $sponsor)
    {
        $relationships = Relationship::pluck("label", "id");
         return view('registrationmanagement::agents.edit',compact('sponsor', 'relationships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $sponsor)
    {
        $this->validate($request, [
            'relationship_id' => 'required',
            'income' => 'required'
        ]);

        if(!$sponsor->update($request->all()))
        {
            return redirect()->back()->withInput()->with('error', 'Data update error, try again later');
        }
        return redirect()->route('agents.show', $sponsor->id)->with('success','Agent Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $sponsor)
    {
        $sponsor->delete();
        return redirect()->back()
                        ->with('success','Agent deleted successfully');
    }
}
