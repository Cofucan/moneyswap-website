<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Uom;
use Modules\CatalogManagement\Entities\Price;
use Modules\CatalogManagement\Entities\PriceCategory;
use Modules\CatalogManagement\Entities\Feature;
use Modules\CatalogManagement\Traits\PriceTrait;
use Illuminate\Http\Request;
use Carbon\carbon;

class PriceController extends Controller
{
    use PriceTrait;
    public function __construct()
    {

    }

    public function manage()
    {
        $prices = Price::with(['PriceCategory', 'Feature'])->get();
        $pricecategories = PriceCategory::active()->orderBy('label')->get();
        $features = Feature::active()->orderBy('label')->get();
        return view('catalogmanagement::prices.manage', compact('prices', 'pricecategories', 'features'));
    }

    public function toggle(Price $price)
    {
        $price->published = !$price->published;
        if (! $price->save()) {
            return redirect()->back()->with('error', 'Could not update Price');
        }

        $feedback = $price->published ? 'Price Enabled successfully' : 'Price Disabled successfully';
        return redirect()->back()->with('success', $feedback);
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
        //
        $pricecategories = PriceCategory::active()->orderBy('label')->get();
        $features = Feature::active()->orderBy('label')->get();
        return view('catalogmanagement::prices.create', compact('pricecategories', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->filled('price_category_id') && $request->filled('item_category_id')) {
            $request->merge(['price_category_id' => $request->item_category_id]);
        }
        if (!$request->filled('price_category_id')) {
            $request->merge(['price_category_id' => 1]);
        }
        $this->validate($request, [
            'price_category_id' => 'required',
            'label' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->savePrice()) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong with data entry');
        }
        return redirect()->back()->with('success','Price Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Price  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //       
        $pricecategories = PriceCategory::active()->orderBy('label')->get();
        $features = Feature::active()->orderBy('label')->get();
        return view('catalogmanagement::prices.show', compact('price', 'pricecategories', 'features'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Price  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
        $pricecategories = PriceCategory::active()->orderBy('label')->get();
        $features = Feature::active()->orderBy('label')->get();
        return view('catalogmanagement::prices.edit', compact('price', 'pricecategories', 'features'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Price  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
        //dd($request->all());
        $this->validate($request, [
            'label' => 'required',
        ]);
        if ($request->filled('price_category_id') && !$request->filled('item_category_id')) {
            $request->merge(['item_category_id' => $request->price_category_id]);
        }
        $request->merge([
            'cost_price' => (float) str_replace(',', '', $request->cost_price)
        ]);
        if( !$price->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Price Updated Successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Price  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //
        if($price->preset == true)
        {
            return redirect()->back()
                        ->with('warning',' Preset Catalog price cannot be deleted. Disable if not in use');
        }
        if($price->fees->count() >0 or $price->expenses->count() > 0)
        {
            return redirect()->back()
                        ->with('warning',' Catalog price is in use by other services. Deletion Failed');
        }
        $price->delete();
        return redirect()->back()
                        ->with('success',' Catalog price deleted successfully');
    }
}
