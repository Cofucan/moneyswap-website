<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Uom;
use Modules\CatalogManagement\Entities\Item;
use Modules\CatalogManagement\Traits\ItemTrait;
use Illuminate\Http\Request;
use Carbon\carbon;

class ItemController extends Controller
{
    use ItemTrait;
    public function __construct()
    {

    }

    public function manage()
    {
        $items = Item::all();
        return view('catalogmanagement::items.manage', compact('items'));
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
        $itemcategories = ItemCategory::active()->get();
        return view('catalogmanagement::items.create', compact('expenses'));
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
            'item_category_id' => 'required',
            'label' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->saveItem()) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong with data entry');
        }
        return redirect()->back()->with('success','Item Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //       
        return view('catalogmanagement::items.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        return view('catalogmanagement::items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
        //dd($request->all());
        $this->validate($request, [
            'label' => 'required',
        ]);
        $request->merge([
            'cost_price' => (float) str_replace(',', '', $request->cost_price)
        ]);
        if( !$item->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Item Updated Successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        if($item->preset == true)
        {
            return redirect()->back()
                        ->with('warning',' Preset Catalog item cannot be deleted. Disable if not in use');
        }
        if($item->fees->count() >0 or $item->expenses->count() > 0)
        {
            return redirect()->back()
                        ->with('warning',' Catalog item is in use by other services. Deletion Failed');
        }
        $item->delete();
        return redirect()->back()
                        ->with('success',' Catalog item deleted successfully');
    }
}
