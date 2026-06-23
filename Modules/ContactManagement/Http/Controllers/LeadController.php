<?php

namespace Modules\ContactManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContactManagement\Entities\Lead;
use Modules\ContactManagement\Entities\SalesCycle;
use Modules\HumanResources\Entities\Designation;
use Modules\ContactManagement\Traits\ContactTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;

class LeadController extends Controller
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
        $salescycles = SalesCycle::active()->pluck("label", "id");
        $designations = Designation::active()->pluck("job_role", "id");
        $leads = Lead::all();       
        return view ('contactmanagement::leads.index', compact('leads', 'salescycles', 'designations') );
    }
    public function manage()
    {
        //
        $salescycles = SalesCycle::active()->pluck("label", "id");
        $designations = Designation::active()->pluck("job_role", "id");
        $leads = Lead::all();       
        return view ('contactmanagement::leads.manage', compact('leads', 'salescycles', 'designations') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //      
        return view ('contactmanagement::leads.create');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'telephone' => 'required',
        ]);
        $this->data = $request->all();
        if ( ! $this->saveLead()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
        return redirect()->back()->with('success','Lead Added successfully.');
    }
 

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
        $salescycles = SalesCycle::active()->pluck("label", "id");
        return view('contactmanagement::leads.show',compact('lead', 'salescycles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
      
         return view('leads.edit',compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //
        $this->validate($request, [

            'sales_cycle_id' => 'required',

        ]);
        if( ! $lead->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Lead Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
        $lead->delete();
         return redirect()->back()
                         ->with('success','Lead deleted successfully');
    }
}
