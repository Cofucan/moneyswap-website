<?php

namespace Modules\OrganizationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\OrganizationManagement\Entities\Division;
use Modules\ContentManagement\Entities\Page;
use Modules\CalendarManagement\Entities\Program;
use Illuminate\Http\Request;
use  Modules\OrganizationManagement\Traits\DivisionTrait;
use Session;

class DivisionController extends Controller
{
    use DivisionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($slug)
    {
        $division = $this->getDivisionDetails($slug);
        return view('organizationmanagement::divisions.details', compact('division'));
    }   

    public function index()
    {
        //  
        $page_tag = 'division';
        $page = Page::where('page_tag', $page_tag)->first();
        $divisions = $this->getAllDivision();
        return view('organizationmanagement::divisions.index', compact('divisions', 'page'));
    }

    public function manage()
    {
        //  
        $divisions = Division::with('Department')->get();
        return view('organizationmanagement::divisions.manage', compact('divisions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('organizationmanagement::divisions.create');
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
            'label' => 'required',
            'department_id' => 'required',
            'icon.*' => 'image|mimes:jpeg,jpg,png,gif|max:500',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:500'
        ]);
        $this->data = $request->all();
        if(!$this->saveDivision()){
            return redirect()->back()->with('error','Could not create division, please try again later.');
        }   
        
       return redirect()->back()->with('success','Division Added successfully.');

    }

    public function toggle(Division $division)
    {
        if ($division->published == 1) {
            $division->published = 0; 
            $feedback = 'Division Unpublished successfully';        
        } else {
            $division->published = 1;
            $feedback = 'Division Published successfully';
        }
        if ( ! $division->save()) {
            return redirect()->back()->with('error', 'Could not update Division');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
        return view('organizationmanagement::divisions.show',compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        //
        return view('organizationmanagement::divisions.edit',compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        //
        $this->validate($request, [
            // 'icon' => 'required', 
            'label' => 'required',
            'icon.*' => 'image|mimes:jpeg,jpg,png,gif|max:500',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:500'
        ]);
        //dd($request->all());
        if( ! $division->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        } 

       return redirect()->back()->with('success','Division Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        //
        $division->delete();
        return redirect()->back()->with('success','Division deleted successfully');
    }
}
