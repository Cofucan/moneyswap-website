<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ProfileManagement\Entities\Salutation;
use Illuminate\Http\Request;
use SalutationRequest;
use DB;
use Session;
use Excel;
use File;
use Datatables;
class SalutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salutations = Salutation::all ();
        return view ('profilemanagement::salutations.index', compact('salutations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $salutations = Salutation::all();
        //$academic_terms= AcademicTerm::all()->pluck("activity_type");       
        return view('profilemanagement::salutations.create', compact('salutations'));
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
        if (Salutation::create($validated))
        {            
            Session::flash('success', 'Salutation Added successfully.');
            return redirect()->route('manageFacilities')->with('success','Salutation Added successfully.');
        }else{
            Session::flash('error', 'Error inserting the data..');
            //return back();
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salutation  $salutation
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        //
        $salutations = Salutation::all ();        
        return view('profilemanagement::salutations.manage' )->withFacilities($salutations);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salutation  $salutation
     * @return \Illuminate\Http\Response
     */
     public function show(Salutation $salutation)
     {
         return view('profilemanagement::salutations.show',compact('salutation'));
     }
    
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Salutation  $salutation
      * @return \Illuminate\Http\Response
      */
     public function edit(Salutation $salutation)
     {
         $academic_terms = AcademicTerm::all()->pluck("activity_type");
         return view('profilemanagement::salutations.edit',compact('salutation', 'academic_terms'));
     }
   
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Salutation  $Salutation
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Salutation $salutation)
     {  
        
        $salutation->update($request->all());  
         return redirect()->route('manageFacilities')
                         ->with('success','Salutation updated successfully');
     }
   
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Salutation  $salutation
      * @return \Illuminate\Http\Response
      */
     public function destroy(Salutation $salutation)
     {
         $salutation->delete();   
         return redirect()->route('manageFacilities')
                        ->with('success','Salutation deleted successfully');
     }
}
