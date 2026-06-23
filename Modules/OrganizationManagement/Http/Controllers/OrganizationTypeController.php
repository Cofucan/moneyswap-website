<?php

namespace Modules\OrganizationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\OrganizationManagement\Entities\OrganizationType;
use Modules\OrganizationManagement\Entities\Organization;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationTypeController extends Controller
{
   

    public function getroles(Request $request)
    {        
        $organizationtype = $request->organizationtype;       
        $roles = Role::where('organization_type', $organizationtype)->pluck("role_name","id");
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
        $organizationtypes = OrganizationType::all();
        return view('organizationmanagement::organizationtypes.index', compact('organizationtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('organizationmanagement::organizationtypes.create');
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

        $organizationtype = OrganizationType::create($request->input());
        return response()->json($organizationtype);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrganizationType  $organizationtype
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationType $organizationtype)
    {
        //$organizationtype = OrganizationType::find($title_id);
        return response()->json($organizationtype);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrganizationType  $organizationtype
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationType $organizationtype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrganizationType  $organizationtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationType $organizationtype)
    {
        //

        $organizationtype = OrganizationType::find($organizationtype->id);
        $organizationtype->organization_type = $request->organization_type;
        $organizationtype->public_name = $request->public_name;
        $organizationtype->overview = $request->overview;
        $organizationtype->published = $request->published;
        $organizationtype->save();
        return response()->json($organizationtype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrganizationType  $organizationtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationType $organizationtype)
    {
        //
        $organizationtype->delete();
        return response()->json($organizationtype);
                         // ->with('success','OrganizationType deleted successfully');

    }
}
