<?php

namespace Modules\candidatemanagement\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ClientManagement\Entities\Outlet;
use Modules\candidatemanagement\Entities\Cohort;
use Modules\candidatemanagement\Entities\Client;
use Modules\SchoolManagement\Entities\Batch;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Illuminate\Http\Request;
use Modules\candidatemanagement\Traits\CohortTrait;
use Session;

class CohortController extends Controller
{
    use CohortTrait;
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $cohorts = Cohort::available()->get();
        return view('candidatemanagement::cohorts.index', compact('cohorts'));
    }


    public function manage()
    {
        $cohorts = Cohort::all();
        $batches = Batch::active()->pluck("label", "id");
        $outlets = Outlet::active()->pluck("label", "id");
        $academicterms = AcademicTerm::active()->pluck("label", "id");
        return view('candidatemanagement::cohorts.manage', compact('cohorts', 'batches', 'outlets', 'academicterms'));
    }

    public function academicterm(AcademicTerm $academicterm)
    {
        $cohorts = Cohort::term($academicterm->id)->get();
        return view('candidatemanagement::cohorts.academicterm', compact('cohorts', 'academicterm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::active()->pluck("label", "id");
        $batches = Batch::active()->get()->pluck("label", "id");
        $academicterms = AcademicTerm::active()->pluck("label", "id");
        return view('candidatemanagement::cohorts.create', compact('academicterms','batches', 'outlets'));
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
            'academic_term_id' => 'required',
            'batch_id' => 'required',
            'outlet_id' => 'required'
        ]);
        $this->data = $request->all();
        $cohort = $this->saveCohort();
        if ( !$cohort) {
            return redirect()->back()->withInput()->withErrors('error', 'Error inserting the data..');
        }
       return redirect()->route('cohorts.show', $cohort)->with('success','client cohort created successfully.');

    }

    public function process(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
           'cohort_id' => 'required',
           'status' => 'required'
        ]);

        $this->data = $request->all();
        $cohort = $this->processCohort();
        if($cohort)
        {
            return redirect()->back()->with('success','Action performed successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function show(Cohort $cohort)
    {
        $outlets = Outlet::active()->pluck("label", "id");
        $batches = Batch::active()->get()->pluck("label", "id");
        $academicterms = AcademicTerm::available()->pluck("label", "id");
        return view('candidatemanagement::cohorts.show',compact('cohort', 'academicterms','batches', 'outlets'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function edit(Cohort $cohort)
    {
        //
        $outlets = Outlet::active()->pluck("label", "id");
        $batches = Batch::active()->get()->pluck("label", "id");
        $academicterms = AcademicTerm::available()->pluck("label", "id");
        return view('candidatemanagement::cohorts.edit', compact('cohort', 'academicterms','batches', 'outlets'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cohort $cohort)
    {
        //
        $this->validate($request, [
            // 'label' => 'required',
        ]);
        if ( !$cohort->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again later');
        }
       return redirect()->back()->with('success','Client group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cohort  $cohort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cohort $cohort)
    {
        //
        if($cohort->clients->count() >0)
        {
            Client::where('cohort_id', $cohort->id)->delete();
        }
        $cohort->delete();
        return redirect()->back()->with('success','Cohort and all associated clients deleted successfully');
    }
}
