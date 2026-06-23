<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class ClockType extends Model
{
    //
    protected $fillable = [
        'label',
        'max_days', 
        'enabled'
        ];
    public function Clocks()
    {
        return $this->hasMany(Clock::class);
    }
    
}
