<?php

namespace App\Http\Controllers;

use App\Models\SecurityQuestion;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use NeighbourhoodRequest;
use DB;
use Session;
use Excel;
use File;
use Datatables;

class SecurityQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $securityquestions = SecurityQuestion::all ();
        return view ('securityquestions.index', compact('securityquestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $securityquestions = SecurityQuestion::all();
        $academic_terms= AcademicTerm::all()->pluck("activity_type");       
        return view('securityquestions.create', compact('securityquestions', 'academic_terms'));
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
        $validated = $request->all();            
        if (SecurityQuestion::create($validated))
        {            
            Session::flash('success', 'SecurityQuestion Added successfully.');
            return redirect()->route('manageSecurityQuestions')->with('success','SecurityQuestion Added successfully.');
        }else{
            Session::flash('error', 'Error inserting the data..');
            //return back();
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SecurityQuestion  $securityquestion
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        //
        $securityquestions = SecurityQuestion::all ();        
        return view ( 'securityquestions.manage' )->withFacilities($securityquestions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SecurityQuestion  $securityquestion
     * @return \Illuminate\Http\Response
     */
     public function show(SecurityQuestion $securityquestion)
     {
         return view('securityquestions.show',compact('securityquestion'));
     }
    
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\SecurityQuestion  $securityquestion
      * @return \Illuminate\Http\Response
      */
     public function edit(SecurityQuestion $securityquestion)
     {
         $academic_terms = AcademicTerm::all()->pluck("activity_type");
         return view('securityquestions.edit',compact('securityquestion', 'academic_terms'));
     }
   
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\SecurityQuestion  $SecurityQuestion
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, SecurityQuestion $securityquestion)
     {  
        
        $securityquestion->update($request->all());  
         return redirect()->route('manageSecurityQuestions')
                         ->with('success','SecurityQuestion updated successfully');
     }
   
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\SecurityQuestion  $securityquestion
      * @return \Illuminate\Http\Response
      */
     public function destroy(SecurityQuestion $securityquestion)
     {
         $securityquestion->delete();   
         return redirect()->route('manageSecurityQuestions')
                         ->with('success','SecurityQuestion deleted successfully');
     }
}
