<?php

namespace Modules\HumanResources\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\carbon;
use Auth;
class Employee extends Model
{
    use HasFactory, Hashidable;
    protected $fillable =[
        'id_number',
        'hired_at',
        'status', // NewHire, Probation, Confirmed, Fired, Resigned
        'designation_id',
        'employment_type_id',
        'profile_id',
        'is_active',
        'creator_user_id',
        'disengaged_at'
    ];

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->creator_user_id = Auth::id();
            $model->status = 'Pending';
        });
        self::deleting(function($model) { // before delete() method call this
            $model->profile->delete();
            if($model->officialappoints->count() >0)
            {
                $model->officialappoints()->each(function($officialappoint){
                    $officialappoint->delete();
                });
            }

       });

    }

    public function getStaffNameAttribute()
    {
        return $this->Profile->full_name;
    }
    public function getTypeAttribute()
    {
        return $this->EmploymentType->label;
    }
    public function getNameAttribute()
    {
        return $this->Profile->full_name;
    }

    public function getPositionAttribute()
    {
        return $this->Designation->job_role;
    }

    public function getEmployeeCodeAttribute()
    {
     if($this->id_number > 0)
     {
         return "MNS/".Str::padLeft($this->id_number,5,'0');
        //  return "SKP/".Str::pad($this->id_number,5,'0',str::PAD_LEFT);
     }
     return 'N/A';
    }
    
    public function getYearsInServiceAttribute()
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

    public function getDateLeftAttribute($value)
    {
        if(is_null($value))
        {
            return "N/A";
        }
        return Carbon::parse($value)->toFormattedDateString();
    }
    public function scopeActive($query)
    {
        return $query->with('Designation', 'EmploymentType', 'Profile')->where('is_active', true);
    }
    
    public function scopeFormer($query)
    {
    return $query->with('Designation', 'EmploymentType')->whereNotNuLL('disengaged_at')->orderBy('disengaged_at', 'ASC');
    }

    public function scopeAvailable($query)
    {
        return $query->with('Designation', 'EmploymentType');
    }
    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }

    public function Designation()
    {
        return $this->belongsTo(Designation::class);
    }
    public function EmploymentType()
    {
        return $this->belongsTo(EmploymentType::class);
    }

}
