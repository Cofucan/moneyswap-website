<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ProfileManagement\Entities\Vital;
use Modules\ProfileManagement\Entities\Profile;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Http\Request;
use Session;


class VitalController extends Controller
{
    use ProfileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'profile_id' => 'required',
            'blood_group' => 'required',          
            'genotype' => 'required'         

        ]);
        // dd($request->all());
        $this->data = $request->all();
        if ( ! $this->saveVital()) {
 
            return redirect()->back()->withInput()->withErrors('error', 'Error inserting the data..');
        }
       return redirect()->back()->with('success','Vital Added successfully.');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function show(Vital $vital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function edit(Vital $vital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vital $vital)
    {
        //
        $this->validate($request, [

            'blood_group' => 'required',           
            'genotype' => 'required',
           
        ]);
           
        if( !$vital->update($request->all())) {
            
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Vital Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vital  $vital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vital $vital)
    {
        //
    }
}
