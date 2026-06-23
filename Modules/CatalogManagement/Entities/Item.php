<?php

namespace Modules\CatalogManagement\Entities;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Rates;
class Item extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'item_category_id',
        'sku',
        'label',
        'slug',
        'overview',
        'cost_price', //nullable
        'is_selling',
        'uom',
        'user_id',
        'preset',
        'status', //Schedulled, Approved
        'published'
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->published = true;
            $model->sku = Str::padLeft(Item::max('sku')+1, 5, '0');
            $model->preset = false;
        });
        static::saving(function ($model) {
            $model->user_id = Auth::id();
            $model->slug = Str::slug($model->label);
        });
    }
    public function getPriceAttribute()
    {
        if(is_null($this->cost))
        {
            return 'Free';
        }
        if($this->fixed == false)
        {
            return 'From '. $this->cost. '%';
        }
        return $this->cost. '%';
    }

    public function getFlatRateAtribute()
    {
        if($this->rate == 'Percentage')
        {
            return '%';
        }
        return ' ';
    }
   

    public function getUnitAttribute()
    {
        if(is_null($this->uom))
        {
            return NULL;
        }
        return ' /'.$this->uom;
    }

    public function getCategoryAttribute()
    {

        return $this->ItemCategory->label;
    }
    
    public function ItemCategory()
    {
        return $this->belongsTo(ItemCategory::class)->withDefault();
    }


    public function scopeScheduled($query)
    {
        return $query->with('ItemCategory')->where('status', 'Scheduled');
    }

    public function scopeActive($query)
    {
        return $query->with('ItemCategory')->where('published', true);
    }
    public function scopeAvailable($query, $group = null)
    {
        $outcome = $query->with('ItemCategory');
        if($group == 'expendable')
        {
            $outcome->where('is_selling', false);
        }else{
            $outcome->where('is_selling', true);
        }
        return $outcome->orderBy('label', 'ASC');
    }
    
}
