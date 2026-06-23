<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Uom;
use Modules\CatalogManagement\Entities\PriceCategory;
use Modules\SchoolManagement\Entities\Program;
use Modules\SchoolManagement\Entities\Level;
use Illuminate\Http\Request;
use Modules\CatalogManagement\Traits\PriceTrait;
use Session;

class PriceCategoryController extends Controller
{
    use PriceTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $pricecategories = PriceCategory::all();
        $uoms = Uom::all()->pluck("uom_title", "uom");
        return view('catalogmanagement::pricecategories.index', compact('pricecategories', 'uoms'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('catalogmanagement::pricecategories.create');
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
            'label' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->savePriceCategory()) {
            return redirect()->back()->withInput()->withErrors('error', 'Error inserting the data..');
        }

       return redirect()->back()->with('success','Price Category Added successfully.');

    }

    public function toggle(PriceCategory $pricecategory)
    {
        if ($pricecategory->published == true) {
            $pricecategory->published = false;
            $feedback = 'Price Category Unpublished successfully';
        } else {
            $pricecategory->published = true;
            $feedback = 'Price Category Unpublished successfully';
        }
        if ( ! $pricecategory->save()) {
            return redirect()->back()->with('error', 'Could not update Price Category');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PriceCategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function show(PriceCategory $pricecategory)
    {
        //
        $pricecategories = PriceCategory::active()->pluck("label", "id");
        $uoms = Uom::all()->pluck("uom_title", "uom");
        $levels = Level::active()->pluck("label", "id");
        $programs = Program::wherePublished(true)->pluck("label", "id");
        return view('catalogmanagement::pricecategories.show',compact('pricecategory', 'uoms', 'pricecategories', 'levels', 'programs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PriceCategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceCategory $pricecategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PriceCategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceCategory $pricecategory)
    {
        //
        $this->validate($request, [
            'label' => 'required',
        ]);
        if ( !$pricecategory->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again later');
        }

       return redirect()->back()->with('success','Price Category Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PriceCategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceCategory $pricecategory)
    {
        //
        if($pricecategory->preset == true)
        {
            return redirect()->back()
                        ->with('warning',' Preset Catalog category cannot be deleted. Disable if not in use');
        }
        if($pricecategory->Prices->count() >0)
        {
            return redirect()->back()
                        ->with('warning','Catalog Category is in use by other services. Deletion Failed');
        }
        $pricecategory->delete();
        return redirect()->back()->with('success','Category deleted successfully');
    }
}
