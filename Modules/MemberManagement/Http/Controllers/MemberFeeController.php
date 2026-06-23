<?php

namespace Modules\MemberManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\MemberManagement\Entities\MemberFee;
use Modules\FeeManagement\Entities\FeeType;
use Modules\SchoolManagement\Entities\Program;
use Illuminate\Http\Request;

class MemberFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->stages = [
            'Pre-registration' => 'When Applying',
            'Registered' => 'Screening  ',
            'Member' => 'When Offered Member',
            'Admitted' => 'Admitted',
        ];
        $this->feeTypes = FeeType::all()->pluck("fee_type", "id");
        $this->programs = Program::where('published', true)->pluck("label", "id");
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $member_stages = $this->stages;
        $feeTypes = $this->feeTypes;
        $programs = $this->programs;
        return view('memberfees.create', compact('feeTypes', 'programs', 'member_stages'));
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
            'fee_type_id' => 'required',
            'member_stage' => 'required',
            'amount_due' =>'required',
            'programs' => 'required'
        ]);
        $data = $request->all();
        //dd($data);
        foreach($request->programs as $key => $value) {
            $this->memberfee = new MemberFee;
            $data['program_id'] =  $value;
            if ( !$this->saveMemberFee($data)) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }
        return redirect()->route('memberfees.show', $this->memberfee->id)->with('success','Subject schedule Added successfully.');
    }

    public function saveMemberFee($data)
    {
        $this->program = Program::findorFail($data['program_id']);
        $this->memberfee->member_stage =  $data['member_stage'];
        $this->memberfee->fee_type_id =  $data['fee_type_id'];
        $this->memberfee->amount_due =  $data['amount_due'];
        if ( ! $this->program->MemberFees()->save($this->memberfee)) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->memberfee;
    }

    public function manage()
    {
        $memberfees = MemberFee::all();
        return view('memberfees.manage', compact('memberfees'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\MemberFee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function show(MemberFee $memberfee)
    {
        //
        return view('memberfees.show',compact('memberfee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberFee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberFee $memberfee)
    {
        //
        $employees = Employee::with('Person')->where('employment_type_id', '1')->get();
        $programs = Subject::all()->pluck("subject_title", "id");
        $academic_terms = AcademicTerm::with('Term')->where('active', true)->get();
        return view('memberfees.edit', compact('memberfee', 'employees', 'academic_terms', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberFee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberFee $memberfee)
    {
        //
        $this->validate($request, [
            'fee_type_id' => 'required',
            'member_stage' => 'required',
            'program_id' => 'required'
        ]);
        $data = $request->all();
        //dd($data);
        $this->memberfee = MemberFee::findorFail($request->memberfee->id);
        if($this->saveMemberFee($data))
        {
            return redirect()->route('memberfees.show', $this->memberfee->id)->with('success','Subject schedule Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberFee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberFee $memberfee)
    {
        //
        $memberfee->delete();
        return redirect()->route('manageSubjectSchedules')
                        ->with('success','Schedule deleted successfully');
    }
}
