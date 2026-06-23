<?php

namespace Modules\ContactManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContactManagement\Entities\ContactType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactTypeController extends Controller
{
    public function myTitles()

    {
        return view('contacttypes.my-contacttypes');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $contacttypes = Contacttype::all();
        return view('contacttypes.index', compact('contacttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contacttypes.create');
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

        $contacttype = Contacttype::create($request->input());
        return response()->json($contacttype);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function show(Contacttype $contacttype)
    {
        //$contacttype = Contacttype::find($title_id);
        return response()->json($contacttype);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacttype $contacttype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacttype $contacttype)
    {
        //

        $contacttype = Contacttype::find($contacttype->id);
        $contacttype->contact_type = $request->contact_type;
        // $contacttype->document_type_description = $request->document_type_description;
        $contacttype->save();
        return response()->json($contacttype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacttype $contacttype)
    {
        //
        $contacttype->delete();
        return response()->json($contacttype);
                         // ->with('success','Contacttype deleted successfully');

    }
}
