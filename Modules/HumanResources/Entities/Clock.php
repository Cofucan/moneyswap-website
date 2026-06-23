<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Carbon\carbon;

class Clock extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'employee_id',
        'clock_type_id',
        'time_out',
        'status',
        'creator_user_id',
        'approver_user_id',
        'approved_at'
        ];
    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->creator_user_id = Auth::id();
            $model->status = 'Scheduled';
        });
    }

    public function getDurationAttribute()
    {
        return $this->time_out - $this->time_in;        
    }

    public function getWorkDayAttribute()
    {
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }

    public function getTimeInAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i:m');;
    }

    public function scopeAttendance($query, $employeeId = null, $valuemonth = null)
    {
        if(is_null($valuemonth))
        {
            $valuemonth = Carbon::now()->format('m');
        }
        if(is_null($employeeId))
        {
            $employeeId = Auth::user()->profile->employee->id;
        }
        $query->whereEmployeeId($employeeId)->whereCreated_at($valuemonth);
    }

    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function ClockType()
    {
        return $this->belongsT0(ClockType::class)->withDefault();
    }


}
