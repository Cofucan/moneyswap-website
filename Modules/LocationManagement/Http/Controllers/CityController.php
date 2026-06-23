<?php

namespace Modules\LocationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\LocationManagement\Entities\City;
use Modules\LocationManagement\Entities\State;
use Illuminate\Http\Request;
use Modules\LocationManagement\Exports\CitiesExport;
use Modules\LocationManagement\Imports\CitiesImport;
use Excel;
use DB;
use Session;
use File;
use Datatables;

class CityController extends Controller

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
        $cities = City::all ();
        return view('cities.index', compact('cities', 'states'));


    }
    public function getlistdata()
    {
        // get datatable data

        return Datatables::of(City::query())->make(true);
    }

    public function getlist()
    {
        // display datatable records
        return view('cities.index'); 
    }

    public function getNeighbourhoodList(Request $request)
    {
        $neighbourhoods = DB::table("neighbourhoods") ->where("city_id",$request->city) ->pluck("neighbourhood_name","id");
        return response()->json($neighbourhoods);
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
         //$states = State::lists('state_name', 'state_id');
        return view('locationmanagement::cities.create', compact('states'));
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

            'city_code' => 'required',
            'city_name' => 'required',
            'state_id' => 'required',

        ]);
        $city = new City();
        $city->city_code = $request->city_code;
        $city->city_name = $request->city_name;
        $city->state_id = $request->state_id;
        $city->longitude = $request->longitude;
        $city->latitude = $request->latitude;
        $city->population_estimate = $request->population_estimate;
        $city->about_city = $request->about_city;
        if ( ! $city->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'City Added successfully.');
       return redirect()->back()->with('success','City Added successfully.');

    }

    public function manage()
    {
    $cities = City::all();
    return view('locationmanagement::cities.manage', compact('cities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
        $city = City::findOrFail($city);
        return view('locationmanagement::cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
        $states = State::all()->pluck("state_name", "id");
        return view('locationmanagement::cities.edit',compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */ 
    public function update(Request $request, City $city)
    {
        //
        $this->validate($request, [
            'city_code' => 'required',
            'city_name' => 'required',
            'state_id' => 'required',
        ]);
        //dd($request->all());
        $city = City::findorFail($request->city_id);
        $city->city_code = $request->city_code;
        $city->city_name = $request->city_name;
        $city->state_id = $request->state_id;
        $city->longitude = $request->longitude;
        $city->latitude = $request->latitude;
        $city->population_estimate = $request->population_estimate;
        $city->about_city = $request->about_city;
        if ( ! $city->save()) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       Session::flash('success', 'City Added successfully.');
       return redirect()->back()->with('success','City Updated successfully.');
    }

    public function upload()
    {
        return view('locationmanagement::cities.upload');
    }

    public function export() 
    {
        return Excel::download(new CitiesExport, 'cities.xlsx');
    }

    public function import() 
    {
        Excel::import(new CitiesImport, request()->file('file'));    
        return redirect()->back()->with('success', 'Data imported successfully');          
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
