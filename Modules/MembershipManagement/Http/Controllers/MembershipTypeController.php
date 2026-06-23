<?php

namespace Modules\MembershipManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\MembershipManagement\Entities\MembershipType;
use Modules\MembershipManagement\Entities\Membership;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembershipTypeController extends Controller
{
    public function memberships(Request $request)
    {        
        $membershiptype = $request->membershiptype;       
        $memberships = Membership::where('membership_type', $membershiptype)->pluck("role_name","id");
        return response()->json($memberships);
    }

    public function getroles(Request $request)
    {        
        $membershiptype = $request->membershiptype;       
        $roles = Role::where('membership_type', $membershiptype)->pluck("role_name","id");
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
        $membershiptypes = MembershipType::all();
        return view('membershipmanagement::membershiptypes.index', compact('membershiptypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('membershipmanagement::membershiptypes.create');
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

        $membershiptype = MembershipType::create($request->input());
        return response()->json($membershiptype);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembershipType  $membershiptype
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipType $membershiptype)
    {
        //$membershiptype = MembershipType::find($title_id);
        return response()->json($membershiptype);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembershipType  $membershiptype
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipType $membershiptype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipType  $membershiptype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MembershipType $membershiptype)
    {
        //

        $membershiptype = MembershipType::find($membershiptype->id);
        $membershiptype->membership_type = $request->membership_type;
        $membershiptype->public_name = $request->public_name;
        $membershiptype->overview = $request->overview;
        $membershiptype->published = $request->published;
        $membershiptype->save();
        return response()->json($membershiptype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembershipType  $membershiptype
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipType $membershiptype)
    {
        //
        $membershiptype->delete();
        return response()->json($membershiptype);
                         // ->with('success','MembershipType deleted successfully');

    }
}
