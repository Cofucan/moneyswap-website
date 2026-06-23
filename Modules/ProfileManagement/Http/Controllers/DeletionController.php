<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ProfileManagement\Entities\Deletion;
use Modules\ProfileManagement\Entities\Profile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\ContentManagement\Entities\Page;

class DeletionController extends Controller
{
       

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $profiletypes = Deletion::all();
        return view('profilemanagement::profiletypes.index', compact('profiletypes'));
    }

    public function home()
    {
        $page_tag = 'account-deletion';
        $page = Page::where('page_tag', $page_tag)->first();
        return view('profilemanagement::deletions.create', compact('page', ));
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

        $deletion = Deletion::create($request->input());
        return response()->json($deletion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deletion  $deletion
     * @return \Illuminate\Http\Response
     */
    public function show(Deletion $deletion)
    {
        //$deletion = Deletion::find($title_id);
        return response()->json($deletion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deletion  $deletion
     * @return \Illuminate\Http\Response
     */
    public function edit(Deletion $deletion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deletion  $deletion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deletion $deletion)
    {
        //

        $deletion = Deletion::find($deletion->id);
        $deletion->profile_type = $request->profile_type;
        $deletion->public_name = $request->public_name;
        $deletion->overview = $request->overview;
        $deletion->published = $request->published;
        $deletion->save();
        return response()->json($deletion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deletion  $deletion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deletion $deletion)
    {
        //
        $deletion->delete();
        return response()->json($deletion);
                         // ->with('success','Deletion deleted successfully');

    }
}
