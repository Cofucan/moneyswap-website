<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\PayScale;
use Modules\HumanResources\Entities\Qualification;
use Modules\HumanResources\Entities\EmploymentType;
use Modules\PaymentManagement\Entities\PaymentFrequency;
use Modules\HumanResources\Entities\Designation;
use Illuminate\Http\Request;
use Session;

class SalaryScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->employmentStatus = [
            'Probation' => 'Probation',
            'Confirmed'  => 'Confirmed',
            'Retired'  => 'Retired',
            'Resigned' => 'Resigned'
        ];
        $this->paymentFrequencies= PaymentFrequency::all()->pluck("public_name", "payment_frequency");
        $this->designations = Designation::all()->pluck("designation", "id");
        $this->qualifications = Qualification::all()->pluck("label", "qualification");
        $this->employmentTypes = EmploymentType::all()->pluck("employment_type", "id");
    }

    public function saveSalaryScale($data)
    {

        $this->designation = Designation::findorFail($data['designation_id']);
        $this->salaryscale->qualification =  $data['qualification'];
        $this->salaryscale->employment_status =  $data['employment_status'];
        $this->salaryscale->payment_frequency =  $data['payment_frequency'];
        $this->salaryscale->currency =  $data['currency'];
        $this->salaryscale->basic_pay =  $data['basic_pay'];
        $this->salaryscale->employment_type_id =  $data['employment_type_id'];
        if(isset($data['pay_scale']))
        {
            $this->salaryscale->pay_scale = $data['pay_scale'];
        }else {
            $this->salaryscale->pay_scale = ucfirst($this->designation->designation).' with '. $data['qualification']. ' ('. $data['employment_status'] .')';
        }

        if ( ! $this->designation->PayScales()->save($this->salaryscale)) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->salaryscale;
    }
    public function index()
    {
        //
        $qualifications = $this->qualifications;
        $employmentTypes= $this->employmentTypes;
        $employmentStatus= $this->employmentStatus;
        $paymentFrequencies =$this->paymentFrequencies;
        $designations = $this->designations;
        $payScales = PayScale::all();
        return view('payrollmanagement::salaryscales.index', compact('payScales', 'qualifications', 'designations', 'employmentStatus', 'paymentFrequencies', 'employmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('payrollmanagement::salaryscales.create');
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
            'designation_id' => 'required',
            'qualification' => 'required',
            'payment_frequency' => 'required',
            'employment_type_id' => 'required',
            'basic_pay' => 'required',
            'currency' => 'required',
            'employment_status' => 'required',

        ]);

        $data = $request->all();
        $this->salaryscale = new PayScale;

        if($this->saveSalaryScale($data))
        {

            return redirect()->back()->with('success','Salary Scale Added successfully.');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function show(PayScale $salaryscale)
    {
        //
        $qualifications = $this->qualifications;
        $employmentStatus= $this->employmentStatus;
        $paymentFrequencies =$this->paymentFrequencies;
        $designations = $this->designations;
        return view('payrollmanagement::salaryscales.show',compact('salaryscale', 'qualifications', 'designations', 'employmentStatus', 'paymentFrequencies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function edit(PayScale $payScale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayScale $salaryscale)
    {
        //
        $this->validate($request, [
            'designation_id' => 'required',
            'qualification' => 'required',
            'payment_frequency' => 'required',
            'basic_pay' => 'required',
            'employment_type_id' => 'required',
            'currency' => 'required',
            'employment_status' => 'required',
        ]);
        //dd($request->all());
        $this->salaryscale = PayScale::findorFail($request->salary_scale_id);
        $data = $request->all();

        if($this->saveSalaryScale($data))
        {
            Session::flash('success', 'payScale Added successfully.');
            return redirect()->back()->with('success','Salary Scale updated successfully.');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayScale $salaryscale)
    {
        //
        $salaryscale->delete();
        return redirect()->back()->with('success','PayScale deleted successfully');
    }
}
