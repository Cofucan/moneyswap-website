<?php

namespace Modules\ContactManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class SalesAction extends Model
{
    //
    protected $fillable = [
        'label', 
        'sales_cycle_id',
        'sequence',
    ];

    public function getCycleAttribute()
    {
      
        return $this->SalesCycle->label;
    }

    public function getVisibilityAttribute()
    {
        if($this->enabled == true )
        {
            return 'Enabled';
        }
        return 'Disabled';;
    }

    public function SalesCycle()
    {
        return $this->belongsTo(SalesCycle::class);
    }

}
 