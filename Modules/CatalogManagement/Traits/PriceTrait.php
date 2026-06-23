<?php

namespace Modules\CatalogManagement\Traits;

use Illuminate\Http\Request;
use Modules\CatalogManagement\Entities\Price;
use Modules\CatalogManagement\Entities\PriceCategory;
//use Modules\CommunicationManagement\Traits\ObjectionTrait;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use Session;
use File;


trait PriceTrait {
//use ObjectionTrait;
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     *
     * */

    public function savePrice()
    {

        $price = new Price;
        $price->feature_id = !empty($this->data['feature_id']) ? $this->data['feature_id'] : null;
        $price->item_category_id = !empty($this->data['price_category_id'])
            ? $this->data['price_category_id']
            : (!empty($this->data['item_category_id']) ? $this->data['item_category_id'] : 1);
        $price->label = !empty($this->data['label']) ? $this->data['label'] : $this->label;
        $price->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $price->income_account_id = !empty($this->data['income_account_id']) ? $this->data['income_account_id'] : NULL;
        $price->expense_account_id = !empty($this->data['expense_account_id']) ? $this->data['expense_account_id'] : NULL;
        $price->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        $price->is_selling = !empty($this->data['is_selling']) ? $this->data['is_selling'] : false;
        $price->uom = !empty($this->data['uom']) ? $this->data['uom'] : NULL;
        $price->cost_price = !(float) Str::replace(',', '', !empty($this->data['cost_price']) ? $this->data['cost_price'] : NULL);
        $price->currency = !empty($this->data['currency']) ? $this->data['currency'] : 'NGN';
        if(!$price->save())
        {
            return redirect()->back()->withInput()->withErrors('Error adding price to catalog');
        }
        return $price;
    }

    public function savePriceCategory()
    {
        $priceCategory = new PriceCategory;
        $priceCategory->preset = !empty($this->data['preset']) ? $this->data['preset'] : false;
        $priceCategory->published = !empty($this->data['published']) ? $this->data['published'] : true;
        $priceCategory->label = $this->data['label'];
        $priceCategory->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        if ( !$priceCategory->save()) {
            return redirect()->back()->withInput()->withErrors('Error creating price category');
        }
        return $priceCategory;
    }

    public function processPrice($price = null)
    {
        if(is_null($price)){
            $price_id = !empty($this->data['price_id'])
                ? $this->data['price_id']
                : (!empty($this->data['item_id']) ? $this->data['item_id'] : $this->price_id);
            $price = Price::findorFail($price_id);
        }
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        switch ($status){
            case "Approved":
            $price->date_approved = Carbon::now();
            $price->approved_by = Auth::user()->id;
            break;
            case "Rejected":
            $price->rejection_reason = !empty($this->data['rejection_reason']) ? $this->data['rejection_reason'] : $this->rejection_reason;
            break;

            }
            $price->status = $status;
            $this->destination = 'prices.show';
            if($price->save()){
                return $this->destination;
            }
    }
}
