<?php

namespace Modules\CatalogManagement\Traits;

use Illuminate\Http\Request;
use Modules\CatalogManagement\Entities\Item;
use Modules\CatalogManagement\Entities\ItemCategory;
//use Modules\CommunicationManagement\Traits\ObjectionTrait;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use Session;
use File;


trait ItemTrait {
//use ObjectionTrait;
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     *
     * */

    public function saveItem()
    {

        $item = new Item;
        $item->item_category_id = !empty($this->data['item_category_id']) ? $this->data['item_category_id'] : 1;
        $item->label = !empty($this->data['label']) ? $this->data['label'] : $this->label;
        $item->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $item->income_account_id = !empty($this->data['income_account_id']) ? $this->data['income_account_id'] : NULL;
        $item->expense_account_id = !empty($this->data['expense_account_id']) ? $this->data['expense_account_id'] : NULL;
        $item->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        $item->is_selling = !empty($this->data['is_selling']) ? $this->data['is_selling'] : false;
        $item->uom = !empty($this->data['uom']) ? $this->data['uom'] : NULL;
        $item->cost_price = !(float) Str::replace(',', '', !empty($this->data['cost_price']) ? $this->data['cost_price'] : NULL);
        $item->currency = !empty($this->data['currency']) ? $this->data['currency'] : 'NGN';
        if(!$item->save())
        {
            return redirect()->back()->withInput()->withErrors('Error adding item to catalog');
        }
        return $item;
    }

    public function saveItemCategory()
    {
        $itemCategory = new ItemCategory;
        $itemCategory->preset = !empty($this->data['preset']) ? $this->data['preset'] : false;
        $itemCategory->published = !empty($this->data['published']) ? $this->data['published'] : true;
        $itemCategory->label = $this->data['label'];
        $itemCategory->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        if ( !$itemCategory->save()) {
            return redirect()->back()->withInput()->withErrors('Error creating item');
        }
        return $itemCategory;
    }

    public function processItem($item = null)
    {
        if(is_null($item)){
            $item_id = !empty($this->data['item_id']) ? $this->data['item_id'] : $this->item_id;
            $item = Item::findorFail($item_id);
        }
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        switch ($status){
            case "Approved":
            $item->date_approved = Carbon::now();
            $item->approved_by = Auth::user()->id;
            break;
            case "Rejected":
            $item->rejection_reason = !empty($this->data['rejection_reason']) ? $this->data['rejection_reason'] : $this->rejection_reason;
            break;

            }
            $item->status = $status;
            $this->destination = 'items.show';
            if($item->save()){
                return $this->destination;
            }
    }
}
