<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPlan;
use App\Models\Package;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\HowItWork;
use App\Models\Advantage;
use App\Models\InvestmentDuration;
use App\Models\State;
use App\Traits\PackageTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;
use Datatables;

class InvestmentPlanController extends Controller
{
    use PackageTrait;
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $investmentplans = InvestmentPlan::all ();
        return view('investmentplans.index')->withPaymentplans ($investmentplans);
    }

    public function invest()
    {
        //
        $page_tag = 'investments';
        $page = Page::where('page_tag', $page_tag)->first();
        $packages = Package::published()->orderBy('code', 'ASC')->get();
        $testimonials = Testimonial::cfi()->get();
        $howitworks = HowItWork::investment()->get();
        $advantages = Advantage::wherePublished(true)->get();
        return view('investments.index', compact('packages', 'page', 'testimonials', 'howitworks', 'advantages'));
    }
    public function getplan(Request $request)
    {
        dd($request->all());
    }

    public function toggle(InvestmentPlan $investmentplan)
    {
        if ($investmentplan->published == 1) {
            $investmentplan->published = 0; 
            $feedback = 'investment plan Unpublished successfully';        
        } else {
            $investmentplan->published = 1;
            $feedback = 'investment plan Unpublished successfully';
        }
        if ( ! $investmentplan->save()) {
            return redirect()->back()->with('error', 'Could not update investment plan');
        }
        return redirect()->back()->with('success', $feedback);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $packages = Package::published()->pluck("name", "id");
        return view('investmentplans.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @para  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'package_id' => 'exists:packages,id|required',
            'interest_rate' => 'numeric|required',
            'investment_duration_id' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->addInvestmentPlan()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return back()->with('success','Investment Plan Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function show(InvestmentPlan $investmentplan)
    {
        //
        return view('investmentplans.show',compact('investmentplan'));
    }

    public function manage(Request $request)
    {
        if(empty($request->package))
        {
            $investmentplans = InvestmentPlan::with('Package')->get();
        }else {
            $package = $request->package;
            $investmentplans = InvestmentPlan::where('package_id', $package)->get();
        }

    return view('investmentplans.manage', compact('investmentplans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestmentPlan $investmentplan)
    {
        //
        return view('investmentplans.edit',compact('investmentplan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestmentPlan $investmentplan)
    {
        //
        $this->validate($request, [
            'interest_rate' => 'numeric|required',            
        ]);
        if( ! $investmentplan->update($request->all())) {
            return redirect()->back()->withInput()->with('error', 'Error updating record, please try again later');
        } 
        return redirect()->back()->with('success','Investment plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestmentPlan $investmentplan)
    {
        //
        $investmentplan->delete();
        return redirect()->back()
                        ->with('success','investment plan deleted successfully');
    }
}
