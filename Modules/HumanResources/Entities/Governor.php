<?php

namespace Modules\HumanResources\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\carbon;
use Auth;
class Governor extends Model
{
    use HasFactory, Hashidable;
    protected $fillable =[
      
        'hired_at',
        'status', // NewHire, Probation, Confirmed, Fired, Resigned
        
        'state_id',
        'application_id',
        'profile_id',
        'signature_path',
        'availability',
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

    
    public function getNameAttribute()
    {
        return $this->Profile->full_name;
    }

    public function getPositionAttribute()
    {
        return $this->Designation->job_role;
    }

   

    public function getYearsInServiceAttribute()
    {
        return Carbon::parse($this->hired_at)->age;
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
        return $query->with('Profile')->where('availability', true);
    }
    
    public function scopeAvailable($query)
    {
        return $query->with('Designation', 'EmploymentType');
    }
      
    public function State()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\State');
    }

}
