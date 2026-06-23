<?php

namespace Modules\LocationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\LocationManagement\Entities\Neighbourhood;
use Modules\LocationManagement\Entities\City;
use Modules\LocationManagement\Entities\State;
use Illuminate\Http\Request;
use Modules\LocationManagement\Exports\NeighbourhoodsExport;
use Modules\LocationManagement\Imports\NeighbourhoodsImport;
use Excel;
use Session;
use File;


class NeighbourhoodController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $states = State::all()->pluck("state_name", "id");
        $neighbourhoods = Neighbourhood::with('City')->get();
        return view('locationmanagement::neighbourhoods.index', compact('neighbourhoods', 'states'));

    }
    public function getlistdata()
    {
        // get datatable data

        return Datatables::of(Neighbourhood::query())->make(true);
    }

    public function getlist()
    {
        // display datatable records
        return view('neighbourhoods.index'); 
    }

    public function getNeighbourhoodList(Request $request)
    {
        $neighbourhoods = DB::table("neighbourhoods") ->where("city_id",$request->neighbourhood) ->pluck("neighbourhood_name","id");
        return response()->json($neighbourhoods);
    }

    public function upload()
    {
       return view('locationmanagement::neighbourhoods.upload');
    }

    public function export() 
    {
        return Excel::download(new NeighbourhoodsExport, 'neighbourhoods.xlsx');
    }

    public function import() 
    {
        request()->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        Excel::import(new NeighbourhoodsImport, request()->file('file'));    
        return redirect()->back()->with('success', 'Data imported successfully');          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $states= State::all();
        $states = State::all()->pluck("state_name", "id");
         //$states = State::lists('state_name', 'neighbourhood_name');
        return view('locationmanagement::neighbourhoods.create', compact('states'));
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

            // 'postal_code' => 'required',
            'city_id' => 'required',
            'neighbourhood_name' => 'required',

        ]);
        $neighbourhood = new Neighbourhood();
        $neighbourhood->postal_code = $request->postal_code;
        $neighbourhood->city_id = $request->city_id;
        $neighbourhood->neighbourhood_name = $request->neighbourhood_name;
        $neighbourhood->longitude = $request->longitude;
        $neighbourhood->latitude = $request->latitude;
        $neighbourhood->population_estimate = $request->population_estimate;
        $neighbourhood->about_neighbourhood = $request->about_neighbourhood;
        if ( ! $neighbourhood->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'Neighbourhood Added successfully.');
       return redirect()->back()->with('success','Neighbourhood Added successfully.');

    }

    public function manage()
    {
    $neighbourhoods = Neighbourhood::all();
    return view('locationmanagement::neighbourhoods.manage', compact('neighbourhoods'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function show(Neighbourhood $neighbourhood)
    {
        //
        $neighbourhood = Neighbourhood::findOrFail($neighbourhood);
        return view('locationmanagement::neighbourhoods.show', compact('neighbourhood'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function edit(Neighbourhood $neighbourhood)
    {
        //
        $states = State::all()->pluck("state_name", "id");
        return view('locationmanagement::neighbourhoods.edit',compact('neighbourhood', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Neighbourhood $neighbourhood)
    {
        //
        $this->validate($request, [
            // 'postal_code' => 'required',
            'city_id' => 'required',
            'neighbourhood_name' => 'required',
        ]);
        //dd($request->all());
        $neighbourhood = Neighbourhood::findorFail($request->neighbourhood_id);
        $neighbourhood->postal_code = $request->postal_code;
        $neighbourhood->city_id = $request->city_id;
        $neighbourhood->neighbourhood_name = $request->neighbourhood_name;
        $neighbourhood->longitude = $request->longitude;
        $neighbourhood->latitude = $request->latitude;
        $neighbourhood->population_estimate = $request->population_estimate;
        $neighbourhood->about_neighbourhood = $request->about_neighbourhood;
        if ( ! $neighbourhood->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'Neighbourhood Added successfully.');
       return redirect()->back()->with('success','Neighbourhood Updated successfully.');
    }

    

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neighbourhood $neighbourhood)
    {
        //
        $neighbourhood->delete();
         return redirect()->back()
                         ->with('success','Neighbourhood deleted successfully');
    }
}
