<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\Application;
use  Modules\HumanResources\Traits\ApplicationTrait;

use Modules\ProfileManagement\Entities\Profile;
use Illuminate\Http\Request;

use DB;
use Session;
use Excel;
use File;
use Image;

class ApplicationController extends Controller
{
     use ApplicationTrait;
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
        $applications = Application::all ();
        return view ('humanresources::applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('humanresources::applications.create');
    }

    public function manage()
    {
        //
        $applications = Application::all ();
        return view('humanresources::applications.manage', compact('applications'));
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
            'vacancy_id' => 'required',
            'cover_letter' => 'required',
            'profile_id' => 'required'
        ]);
        $this->data = $request->all();
        if ( $this->saveApplication()) {
            return redirect()->route('applications.show', $this->application_id)->with('success','Application Added successfully.');
        }
    }

    public function process(Request $request)
    {
        //
        $this->validate($request, [
            'application_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        if ( $this->ApplicationProcessor  ()) {
            return redirect()->back()->with('success','Job Application Updated successfully.');
        }
    }

    public function preview(Request $request)
    {
        $application = Application::where("id",$request->application_id)->first();
        return view('humanresources::applications.preview', compact('application'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
        return view('humanresources::applications.show',compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
         return view('humanresources::applications.edit',compact('application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
        $this->validate($request, [
            'cover_letter' => 'required',
        ]);
        $this->application_id = $application->id;
        $this->data = $request->all();
        if ( $this->saveApplication()) {
            return redirect()->back()->with('success','Scoreheet entry Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
        $application->delete();
        return redirect()->back()
                        ->with('success','application entry deleted successfully');
    }
}
