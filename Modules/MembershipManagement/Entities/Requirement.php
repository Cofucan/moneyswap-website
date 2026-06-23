<?php

namespace Modules\MembershipManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{

    protected $fillable = [   
    'label',
    'overview',
    'sequence',
    'enabled'
    ];

    protected $attributes =
    [
        'enabled' => true,
    ];

   
    public function getSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 80, $end = '...');;
    }

    public function getStatusAttribute()
    {
        if($this->enabled == true)
        {
            return 'Enabled';
        }
        return 'Disabled';
    }


    public function getHighlightAttribute()
    {
        return $this->label . '<br> ' . $this->overview;
    }

    public function scopeActive($query)
    {
        return $query->where('enabled', true);
    }

}
