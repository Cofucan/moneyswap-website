<?php

namespace Modules\SocialManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\SocialManagement\Entities\SocialHandle;
use Modules\SocialManagement\Entities\SocialPlatform;
use Illuminate\Http\Request;
use Session;

class SocialhandleController extends Controller
{
    public function __construct()
    {
       
        $this->socialhandles = SocialHandle::all()->pluck("handle_name", "id");
        $this->socialPlatforms = SocialPlatform::all()->pluck("platform_name", "id");

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $socialPlatforms = $this->socialPlatforms;
        $socialhandles = SocialHandle::all ();
        //dd($socialhandles);
        return view('socialmanagement::socialhandles.index', compact('socialhandles', 'socialPlatforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
        return view('socialmanagement::socialhandles.create', compact( 'socialhandles'));
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

            'social_platform_id' => 'required',
            'handle_name' => 'required'

        ]);
        $socialhandle = new SocialHandle;
        $socialhandle->social_platform_id = $request->social_platform_id;
        $socialhandle->organization_id = $request->organization_id;
        $socialhandle->handle_name = $request->handle_name;
        if ( ! $socialhandle->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'designation Added successfully.');
       return redirect()->back()->with('success','SocialHandle Added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialHandle  $socialhandle
     * @return \Illuminate\Http\Response
     */
    public function show(SocialHandle $socialhandle)
    {
        //
        dd($socialhandle->SocialPlatform->icon);
        return view('socialmanagement::socialhandles.show',compact('designation'));
    }

    public function manage()
    {
    $socialhandles = SocialHandle::all();
    return view('socialmanagement::socialhandles.manage', compact('socialhandles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialHandle  $socialhandle
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialHandle $socialhandle)
    {
        //
        $socialhandles = $this->socialhandles;
        $payScales = $this->payScales;
        return view('socialmanagement::socialhandles.edit', compact('designation', 'payScales', 'socialhandles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialHandle  $socialhandle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialHandle $socialhandle)
    {
        //
        $this->validate($request, [
            'social_platform_id' => 'required',
            'handle_name' => 'required'
        ]);
        //dd($request->all());
        $socialhandle = SocialHandle::findorFail($request->social_handle_id);
        $socialhandle->social_platform_id = $request->social_platform_id;
        $socialhandle->organization_id = $request->organization_id;
        $socialhandle->handle_name = $request->handle_name;
        if ( ! $socialhandle->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'designation Added successfully.');
       return redirect()->back()->with('success','SocialHandle Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialHandle  $socialhandle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialHandle $socialhandle)
    {
        //
        $socialhandle->delete();
        return redirect()->back()
                        ->with('success','Social Handle deleted successfully');

    }
}
