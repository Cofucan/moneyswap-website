<?php

namespace App\Http\Controllers;

use App\Models\IncidentCategory;
use Illuminate\Http\Request;
use Session;

class IncidentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incidentcategories = IncidentCategory::all();
        return view('incidentcategories.index', compact('incidentcategories'));
    }

    public function manage()
    {
        //
        $incidentcategories = IncidentCategory::all();
        return view('incidentcategories.index', compact('incidentcategories'));
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
        $this->validate($request, [
            'label' => 'required'
        ]);

        $this->data = $request->all();

        if ( !$this->saveIncidentCategory()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }

       return redirect()->back()->with('success','Incident Category Added successfully.');
    }

    public function saveIncidentCategory()
    {
        $this->incidentcategory = new IncidentCategory;
        $this->incidentcategory->description = !empty($this->data['description']) ? $this->data['description'] : NULL;
        $this->incidentcategory->label = $this->data['label'];
        $this->incidentcategory->published = !empty($this->data['published']) ? $this->data['published'] : true;
        if ( !$this->incidentcategory->save()) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try later');
        }
        return $this->incidentcategory;
    }

    public function toggle(IncidentCategory $incidentcategory)
    {
        if ($incidentcategory->published == 1) {
            $incidentcategory->published = 0;
            $feedback = 'Incident Category Unpublished successfully';
        } else {
            $incidentcategory->published = 1;
            $feedback = 'Incident Category Unpublished successfully';
        }
        if ( ! $incidentcategory->save()) {
            return redirect()->back()->with('error', 'Could not update IncidentCategory');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncidentCategory  $incidentcategory
     * @return \Illuminate\Http\Response
     */
    public function show(IncidentCategory $incidentcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncidentCategory  $incidentcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(IncidentCategory $incidentcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncidentCategory  $incidentcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncidentCategory $incidentcategory)
    {
        //
        $request->validate([
            'label' => 'required',

        ]);

        if ( ! $incidentcategory->update($request->all())) {
            Session::flash('error', 'Error updating incidentcategory..');
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try later');
        }
       Session::flash('success', 'Incident Category updated successfully.');
       return redirect()->back()->with('success','Incident Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncidentCategory  $incidentcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncidentCategory $incidentcategory)
    {
        //
        $incidentcategory->delete();
        return redirect()->back()->with('success','Incident Category deleted successfully');
    }
}
