<?php

namespace Modules\ContactManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class SalesCycle extends Model
{
    //
    protected $fillable=[
        'label',
        'overview', 
        'sequence',
        'enable',

    ];

    protected $attributes =
    [
        // 'contact_tag' => 'Default',
    ];


    public function getVisibilityAttribute()
    {
        if($this->enabled == true )
        {
            return 'Enabled';
        }
        return 'Disabled';
    }

    public function SalesAction()
    {
        return hasMany(SalesAction::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('enabled', true);
    }
}
