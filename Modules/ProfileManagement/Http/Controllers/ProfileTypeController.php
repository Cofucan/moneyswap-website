<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ProfileManagement\Entities\ProfileType;
use Modules\ProfileManagement\Entities\Profile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileTypeController extends Controller
{
    public function profiles(Request $request)
    {        
        $profiletype = $request->profiletype;       
        $profiles = Profile::where('profile_type', $profiletype)->pluck("role_name","id");
        return response()->json($profiles);
    }

    public function getroles(Request $request)
    {        
        $profiletype = $request->profiletype;       
        $roles = Role::where('profile_type', $profiletype)->pluck("role_name","id");
        return response()->json($roles);
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $profiletypes = ProfileType::all();
        return view('profilemanagement::profiletypes.index', compact('profiletypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('profilemanagement::profiletypes.create');
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

        $profiletype = ProfileType::create($request->input());
        return response()->json($profiletype);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfileType  $profiletype
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileType $profiletype)
    {
        //$profiletype = ProfileType::find($title_id);
        return response()->json($profiletype);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfileType  $profiletype
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileType $profiletype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfileType  $profiletype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileType $profiletype)
    {
        //

        $profiletype = ProfileType::find($profiletype->id);
        $profiletype->profile_type = $request->profile_type;
        $profiletype->public_name = $request->public_name;
        $profiletype->overview = $request->overview;
        $profiletype->published = $request->published;
        $profiletype->save();
        return response()->json($profiletype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfileType  $profiletype
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileType $profiletype)
    {
        //
        $profiletype->delete();
        return response()->json($profiletype);
                         // ->with('success','ProfileType deleted successfully');

    }
}
