<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ProfileManagement\Entities\ProfileType;
use Modules\ProfileManagement\Entities\Profile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignaturePadController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('signaturePad');
        return view('profilemanagement::profiletypes.index', compact('profiletypes'));
    }
    public function upload(Request $request)
    {
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $file = $folderPath . uniqid() . '.'.$image_type;
        file_put_contents($file, $image_base64);
        return back()->with('success', 'success Full upload signature');
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
