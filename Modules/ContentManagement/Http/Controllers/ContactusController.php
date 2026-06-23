<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Contactus;
use Modules\OrganizationManagement\Entities\Outlet;
use Illuminate\Http\Request;
use Modules\ContentManagement\Entities\Page;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_tag = 'contactus';
        $page = Page::where('page_tag', $page_tag)->first();
        $outlets = Outlet::active()
            ->with(['City.State.Country'])
            ->orderBy('label')
            ->get();

        $outletsByCountry = $outlets->groupBy(function ($outlet) {
            $country = data_get($outlet, 'City.State.Country.label')
                ?: data_get($outlet, 'City.State.Country.country_name')
                ?: data_get($outlet, 'City.State.Country.name')
                ?: data_get($outlet, 'City.State.Country.country_code')
                ?: data_get($outlet, 'City.State.Country.code');

            if (empty($country)) {
                return 'Other Locations';
            }

            $country = trim((string) $country);

            return strlen($country) <= 3 ? strtoupper($country) : $country;
        })->sortKeys();

        return view('contentmanagement::contactus.index', compact('outlets', 'outletsByCountry', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show(Contactus $contactus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactus $contactus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactus $contactus)
    {
        //
    }
}
