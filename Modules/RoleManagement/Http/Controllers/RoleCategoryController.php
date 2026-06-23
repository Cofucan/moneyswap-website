<?php

namespace Modules\RoleManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\RoleManagement\Entities\RoleCategory;
use Modules\ProfileManagement\Entities\Profile;
use Modules\RoleManagement\Entities\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleCategoryController extends Controller
{
    public function profiles(Request $request)
    {
        $rolecategory = $request->rolecategory;
        $profiles = Profile::where('role_category_id', $rolecategory)->pluck("label","id");
        return response()->json($profiles);
    }

    public function getroles(Request $request)
    {
        $rolecategory = $request->rolecategory;
        $roles = Role::where('role_category_id', $rolecategory)->pluck("label","id");
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
        $rolecategories = Rolecategory::all();
        return view('rolemanagement::rolecategories.index', compact('rolecategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rolemanagement::rolecategories.create');
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

        $rolecategory = Rolecategory::create($request->input());
        return response()->json($rolecategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rolecategory  $rolecategory
     * @return \Illuminate\Http\Response
     */
    public function show(Rolecategory $rolecategory)
    {
        //$rolecategory = Rolecategory::find($title_id);
        return response()->json($rolecategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rolecategory  $rolecategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Rolecategory $rolecategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rolecategory  $rolecategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rolecategory $rolecategory)
    {
        //

        $rolecategory = Rolecategory::find($rolecategory->id);
        $rolecategory->profile_type = $request->profile_type;
        $rolecategory->public_name = $request->public_name;
        $rolecategory->overview = $request->overview;
        $rolecategory->published = $request->published;
        $rolecategory->save();
        return response()->json($rolecategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rolecategory  $rolecategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rolecategory $rolecategory)
    {
        //
        $rolecategory->delete();
        return response()->json($rolecategory);
                         // ->with('success','Rolecategory deleted successfully');

    }
}
