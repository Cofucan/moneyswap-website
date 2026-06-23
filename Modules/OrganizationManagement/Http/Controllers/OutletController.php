<?php

namespace Modules\OrganizationManagement\Http\Controllers;
use App\Http\Controllers\Controller;

use Modules\OrganizationManagement\Entities\Outlet;
use Modules\LocationManagement\Entities\State;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\Neighbourhood;
use Illuminate\Http\Request;
use Modules\OrganizationManagement\Traits\OrganizationTrait;

class OutletController extends Controller
{
    use OrganizationTrait;
    public function __construct()
    {
        $this->addressPrefix = [
        'No',
        'Plot',
        'Suite',
        'Block'
        ];

        $this->outletTypes = [
            'HeadQuarter' => 'HeadQuarter',
            'Branch' => 'Branch'
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outletTypes = $this->outletTypes;
        $addressPrefix = $this->addressPrefix;
        $states = State::all()->pluck("state_name", "id");
        $countries = Country::active()->pluck("label", "code");
        return view('organizationmanagement::outlets.create', compact('states', 'countries', 'addressPrefix', 'outletTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'label' => 'required_without:outlet_label',
            'outlet_label' => 'required_without:label',
            'street_name' => 'required',
            'building_number' => 'required_without:building_no',
            'building_no' => 'required_without:building_number',
            'city_id' => 'required_without:city_name|nullable|exists:cities,id',
            'city_name' => 'required_without:city_id|nullable|string',
            'state_name' => 'required_with:city_name|nullable|string',
            'country_code' => 'required_with:city_name|nullable|exists:countries,code',
            'organization_id' => 'nullable|exists:organizations,id',
        ]);

        $this->data = $request->all();
        $this->data['label'] = $request->input('label', $request->input('outlet_label'));
        $this->data['building_number'] = $request->input('building_number', $request->input('building_no'));
        if ($request->filled('country_code')) {
            $this->data['country_id'] = Country::where('code', $request->country_code)->value('id');
        }

        if (! $this->saveOutlet()) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong, please try again');
        }

        if ($request->filled('organization_id')) {
            return redirect()
                ->route('organizations.show', $request->organization_id)
                ->with('success', 'Outlet added successfully.');
        }

        return redirect()->back()->with('success', 'Outlet added successfully.');
    }

    public function toggle(Outlet $outlet)
    {
        if ($outlet->published == true) {
            $outlet->published = false;
            $feedback = 'Outlet Unpublished successfully';
        } else {
            $outlet->published = true;
            $feedback = 'Outlet Published successfully';
        }
        if ( ! $outlet->save()) {
            return redirect()->back()->with('error', 'Could not update Outlet');
        }
        return redirect()->back()->with('success', $feedback);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        $outlet->load('City', 'Organization');
        return view('organizationmanagement::outlets.show',compact('outlet'));
    }

    public function manage()
    {
        $outlets = Outlet::with('City', 'Organization')->orderBy('id', 'desc')->get();
        return view('organizationmanagement::outlets.manage', compact('outlets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        $outletTypes = $this->outletTypes;
        return view('organizationmanagement::outlets.edit', compact('outlet', 'outletTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        $this->validate($request, [
            'label' => 'required_without:outlet_label',
            'outlet_label' => 'required_without:label',
            'street_name' => 'required',
            'building_number' => 'required_without:building_no',
            'building_no' => 'required_without:building_number',
            'outlet_type' => 'required',
            'city_id' => 'nullable|exists:cities,id',
            'city_name' => 'nullable|string',
            'state_name' => 'required_with:city_name|nullable|string',
            'country_code' => 'required_with:city_name|nullable|exists:countries,code',
        ]);

        $this->data = $request->all();
        if ($request->filled('country_code')) {
            $this->data['country_id'] = Country::where('code', $request->country_code)->value('id');
        }
        $outlet->label = $request->input('label', $request->input('outlet_label'));
        $outlet->outlet_code = $request->input('outlet_code', $outlet->outlet_code);
        $outlet->outlet_type = $request->input('outlet_type');
        $outlet->building_number = $request->input('building_number', $request->input('building_no'));
        $outlet->street_name = $request->input('street_name');
        $outlet->telephone = $request->input('telephone');

        if ($request->filled('city_id')) {
            $outlet->city_id = $request->city_id;
        } elseif ($request->filled('city_name')) {
            $outlet->city_id = $this->makeCity()->id;
        }

        if (! $outlet->save()) {
            return redirect()->back()->withInput()->with('error', 'Error updating outlet.');
        }

        return redirect()->route('outlets.manage')->with('success', 'Outlet updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        //
        $outlet->delete();
        return redirect()->back()->with('success','Business outlet deleted successfully');
    }
}
