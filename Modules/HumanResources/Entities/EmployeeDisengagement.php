<?php

namespace Modules\HumanResources\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\carbon;

class EmployeeDisengagement extends Model
{
    use HasFactory, Hashidable;
    protected $fillable =[
        'employee_id',
        'left_at',
        'status', // Notice, Request, Approved, Rejected, Cancelled,
        'reason', // why the employee left or need to leave
        'document_path',
        'modality', //Absconded, Fired, Resigned
        'user_id'
    ];
    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->status = 'Approved';
        });

    }

    public function getEmpolymentDurationAttribute()
    {
        return Carbon::parse($this->hired_at)->age;
    }

    public function getDateEmployeedAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function setHireDateAttribute($value)
    {
    $this->attributes['hired_at'] = date('Y-m-d', strtotime($value));
    }


    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
