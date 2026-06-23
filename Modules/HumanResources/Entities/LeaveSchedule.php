<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;

class LeaveSchedule extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'designation_id',
        'leave_type_id',
        'days',
        'enabled'
        ];
    public function getDaysAllowedAttribute($designationId)
    {
        return $this->Position($designationId)->sum('days');
    }
    public function scopeActive($query)
    {
        return $query->whereEnabled(true);
    }
    public function scopePosition($query, $designationId)
    {
        return $query->whereDesignationId($designationId);
    }
    public function Designation()
    {
        return $this->belongsTo(Designation::class);
    }
    public function LeaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function Leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
