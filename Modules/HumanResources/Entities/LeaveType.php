<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    //
    protected $fillable = [
        'label',
        'max_days', 
        'enabled'
        ];
    public function LeaveSchedules()
    {
        return $this->hasMany(LeaveSchedule::class);
    }
    public function Leaves()
    {
        return $this->hasManyThrough(Leave::class, LeaveSchedule::class);
    }
    
}
