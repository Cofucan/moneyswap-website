<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\IncidentCategory;
use App\Traits\IncidentTrait;
use Illuminate\Http\Request;
use Auth;

class IncidentController extends Controller
{
    use IncidentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */       
    

    public function __construct()
    {
        
        $this->severities = [
            'Low', 
            'Medium',
            'High' 
        ];
       
    }

    public function index()
    {
        //
    }
    public function home()
    {
        //        
        $incidents = Incident::own();
        $severities = $this->severities;
        $incidentcategories = IncidentCategory::active()->pluck("label", "id");
        return view('incidents.home', compact('incidents', 'incidentcategories', 'severities'));

    }
    public function manage()
    {
        //
        $incidentcategories = IncidentCategory::active()->pluck("label", "id");
        $severities = $this->severities;
        $incidents = Incident::all();
        return view('incidents.manage', compact('incidents', 'incidentcategories', 'severities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $incidentcategories = IncidentCategory::active()->pluck("label", "id");
        return view('incidents.create', compact('incidentcategories'));
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
            'incident_category_id' => 'required',
            'label' => 'required',
            'overview' => 'required'
        ]);
        $this->data = $request->all();

        if ( !$this->saveIncident()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return redirect()->back()->with('success','Incident Added successfully.');
    }

     

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        //
        return view('incidents.show', compact('incident'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function edit(Incident $incident)
    {
        //
        return view('incidents.edit',compact('incident'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incident $incident)
    {
        //
        $request->validate([
            'label' => 'required',
            'overview' => 'required'
        ]);

        if ( ! $incident->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('Something went wrong');
        }
       return redirect()->back()->with('success','Incident Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        //
        $incident->delete();
         return redirect()->back()
                         ->with('success','Incident deleted successfully');
    }
}
