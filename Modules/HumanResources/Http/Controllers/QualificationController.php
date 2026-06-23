<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\HumanResources\Entities\Qualification;
use Modules\SchoolManagement\Entities\Program;
use Illuminate\Http\Request;
use Session;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->programs = Program::all()->pluck("label", "id");

    }
    public function index()
    {
        //
        $programs = $this->programs;
        $qualifications = Qualification::all();
        return view('humanresources::qualifications.index', compact('qualifications', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('humanresources::qualifications.create');
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

            'acronym' => 'required',

        ]);
        $qualification = new Qualification();
        $qualification->acronym = $request->acronym;
        $qualification->label = $request->label;
        $qualification->program_id = $request->program_id;
        if ( ! $qualification->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'qualification Added successfully.');
       return redirect()->back()->with('success','Qualification Added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Qualification $qualification)
    {
        //
        return view('humanresources::qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qualification $qualification)
    {
        //
        $this->validate($request, [
            'acronym' => 'required',
        ]);
        if ( ! $qualification->update($request->all())) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
       return redirect()->back()->with('success','Qualification Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        //
        $qualification->delete();
        return redirect()->back()->with('success','Qualification deleted successfully');
    }
}
