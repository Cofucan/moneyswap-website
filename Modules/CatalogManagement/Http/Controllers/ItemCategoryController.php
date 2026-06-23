<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Uom;
use Modules\CatalogManagement\Entities\ItemCategory;
use Modules\SchoolManagement\Entities\Program;
use Modules\SchoolManagement\Entities\Level;
use Illuminate\Http\Request;
use Modules\CatalogManagement\Traits\ItemTrait;
use Session;

class ItemCategoryController extends Controller
{
    use ItemTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $itemcategories = ItemCategory::all();
        $uoms = Uom::all()->pluck("uom_title", "uom");
        return view('catalogmanagement::itemcategories.index', compact('itemcategories', 'uoms'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('catalogmanagement::itemcategories.create');
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
        if ( ! $this->saveitemCategory()) {
            return redirect()->back()->withInput()->withErrors('error', 'Error inserting the data..');
        }

       return redirect()->back()->with('success','Catalog Category Added successfully.');

    }

    public function toggle(ItemCategory $itemcategory)
    {
        if ($itemcategory->published == true) {
            $itemcategory->published = false;
            $feedback = 'Item Category Unpublished successfully';
        } else {
            $itemcategory->published = true;
            $feedback = 'Item Category Unpublished successfully';
        }
        if ( ! $itemcategory->save()) {
            return redirect()->back()->with('error', 'Could not update Item Category');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemCategory  $itemcategory
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCategory $itemcategory)
    {
        //
        $itemcategories = ItemCategory::active()->pluck("label", "id");
        $uoms = Uom::all()->pluck("uom_title", "uom");
        $levels = Level::active()->pluck("label", "id");
        $programs = Program::wherePublished(true)->pluck("label", "id");
        return view('catalogmanagement::itemcategories.show',compact('itemcategory', 'uoms', 'itemcategories', 'levels', 'programs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemCategory  $itemcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCategory $itemcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemCategory  $itemcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemCategory $itemcategory)
    {
        //
        $this->validate($request, [
            'label' => 'required',
        ]);
        if ( !$itemcategory->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again later');
        }

       return redirect()->back()->with('success','Catalog Category Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemCategory  $itemcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $itemcategory)
    {
        //
        if($itemcategory->preset == true)
        {
            return redirect()->back()
                        ->with('warning',' Preset Catalog category cannot be deleted. Disable if not in use');
        }
        if($itemcategory->items->count() >0)
        {
            return redirect()->back()
                        ->with('warning','Catalog Category is in use by other services. Deletion Failed');
        }
        $itemcategory->delete();
        return redirect()->back()->with('success','Category deleted successfully');
    }
}
