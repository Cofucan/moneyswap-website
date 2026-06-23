<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;

class Leave extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'employee_id',
        'academic_term_id',
        'leave_schedule_id',
        'start_at',
        'end_at',
        'status',
        'enabled'
        ];
    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->creator_user_id = Auth::id();
            $model->status = 'Scheduled';
            $model->value_date = Carbon::Today();
            $model->time_in = 'Scheduled';
        });

    }
    public function scopeActive($query)
    {
        return $query->whereEnabled(true);
    }
    public function scopeStaff($query, $employeeId)
    {
        return $query->whereEmployeeId($employeeId);
    }
    public function AcademicTerm()
    {
        return $this->belongsTo(AcademicTerm::class);
    }
    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function LeaveSchedule()
    {
        return $this->belongsTo(LeaveSchedule::class);
    }
}
