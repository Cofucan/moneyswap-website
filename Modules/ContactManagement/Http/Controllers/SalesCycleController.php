<?php

namespace Modules\ContactManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContactManagement\Entities\SalesCycle;
use Modules\ContactManagement\Traits\ContactTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;

class SalesCycleController extends Controller
{
use ContactTrait;
    public function __construct()
    {

        

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salescycles = SalesCycle::all();
        return view ('contactmanagement::salescycles.index', compact('salescycles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('contactmanagement::salescycles.create');
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
        ]);
        $this->data = $request->all();
        if ( ! $this->saveSalesCycle()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
        return redirect()->back()->with('success','Sales Cycle Added successfully.');
    }
    

    public function manage()
    {
        //
        $salescycles = SalesCycle::all();       
        return view ('contactmanagement::salescycles.manage', compact('salescycles') );
    }

    public function toggle(SalesCycle $salescycle)
    {
        if ($salescycle->enabled == true) {
            $salescycle->enabled = false; 
            $feedback = 'Sales Cycle Disabled successfully';        
        } else {
            $salescycle->enabled = true;
            $feedback = 'Sales Cycle Enabled successfully';
        }
        if ( ! $salescycle->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $salescycle
     * @return \Illuminate\Http\Response
     */
    public function show(SalesCycle $salescycle)
    {
        //
        return view('contactmanagement::salescycles.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $salescycle
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesCycle $salescycle)
    {
        //
        
         return view('contactmanagement::salescycles.edit',compact('contact', 'contactableTypes', 'contactTypes', 'contactTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $salescycle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesCycle $salescycle)
    {
        //
        $this->validate($request, [

            'label' => 'required',

        ]);
        if( ! $salescycle->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Sales Cycle Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $salescycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesCycle $salescycle)
    {
        //
        $salescycle->delete();
         return redirect()->back()
                         ->with('success','Sales Cycle deleted successfully');
    }
}
