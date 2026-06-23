<?php

namespace Modules\ContactManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContactManagement\Entities\SalesAction;
use Modules\ContactManagement\Entities\SalesCycle;
use Modules\ContactManagement\Traits\ContactTrait;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Excel;
use File;

class SalesActionController extends Controller
{
use ContactTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salescycles = SalesCycle::active()->pluck("label", "id");       
        $salesactions = SalesAction::all();       
        return view ('contactmanagement::salesactions.index', compact('salescycles', 'salesactions') );
    }

    
    public function manage()
    {
        //
        $salescycles = SalesCycle::active()->pluck("label", "id");       
        $salesactions = SalesAction::all();       
        return view ('contactmanagement::salesactions.manage', compact('salescycles', 'salesactions') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $salescycles = SalesCycle::active()->pluck("label", "id");
        return view ('contactmanagement::salesactions.create', compact('salescycles'));
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
            'sales_cycle_id' => 'required',
            'label' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->saveSalesAction()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
        return redirect()->back()->with('success','Sales Action Added successfully.');
    }

    public function toggle(SalesAction $salesaction)
    {
        if ($salesaction->enabled == true) {
            $salesaction->enabled = false; 
            $feedback = 'Sales Action Disabled successfully';        
        } else {
            $salesaction->enabled = true;
            $feedback = 'Sales Action Enabled successfully';
        }
        if ( ! $salesaction->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalesAction  $salesaction
     * @return \Illuminate\Http\Response
     */
    public function show(SalesAction $salesaction)
    {
        //
        return view('salesactions.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesAction  $salesaction
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesAction $salesaction)
    {
        //
       
         return view('salesactions.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesAction  $salesaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesAction $salesaction)
    {
        //
        $this->validate($request, [
            'label' => 'required'

        ]);
        if( ! $salesaction->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Sales Action Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesAction  $salesaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesAction $salesaction)
    {
        //
        $salesaction->delete();
         return redirect()->back()
                         ->with('success','Sales Action deleted successfully');
    }
}
