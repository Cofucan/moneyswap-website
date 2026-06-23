<?php

namespace Modules\LocationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\LocationManagement\Entities\Address;
use Modules\LocationManagement\Entities\State;
use Modules\LocationManagement\Entities\City;
use Modules\LocationManagement\Entities\Neighbourhood;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->addressPrefix = [
        'No',
        'Plot',
        'Suite',
        'Block'
        ];
        $this->neighbourhoods = Neighbourhood::all()->pluck("neighbourhood_name", "id");
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('locationmanagement::addresses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $addressPrefix = $this->addressPrefix;
        $cities = City::all()->pluck("city_name", "id");
        return view('locationmanagement::addresses.create', compact('cities', 'addressPrefix'));
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
            'neighbourhood_id' => 'required',
            'street_name' => 'required',
            'address_no' => 'required'
        ]);
        $neighbourhood = Neighbourhood::findorFail($request->neighbourhood_id);
        $address = new Address;
        $address->address_no = $request->address_no;
        $address->address_prefix = $request->address_prefix;
        $address->street_name = $request->street_name;

        if ( ! $neighbourhood->Addresses()->save($address)) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

       //Session::flash('success', 'street_name Added successfully.');
       return redirect()->route('manageAddresses')->with('success','Address Added successfully.');

    }

    public function manage()
    {
    $addresses = Address::all();
    return view('locationmanagement::addresses.manage', compact('addresses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
        return view('locationmanagement::addresses.show',compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
        $addressPrefix = $this->addressPrefix;
        $cities = City::all()->pluck("city_name", "id");
        return view('locationmanagement::addresses.edit',compact('address', 'cities', 'addressPrefix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
        $this->validate($request, [
            'neighbourhood_id' => 'required',
            'address_no' => 'required',
            'address_prefix' => 'required',
            'street_name' => 'required'
        ]);
        $address = Address::findorFail($request->address->id);
        $neighbourhood = Neighbourhood::findorFail($request->neighbourhood_id);
        $address->address_no = $request->address_no;
        $address->address_prefix = $request->address_prefix;
        $address->street_name = $request->street_name;
        if ( ! $neighbourhood->Addresses()->save($address)) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }

      // Session::flash('success', 'street_name Added successfully.');
       return redirect()->back()->with('success','Address Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
        $address->delete();
        return redirect()->back()
                        ->with('success','Address deleted successfully');
    }
}
