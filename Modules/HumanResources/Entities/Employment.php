<?php

namespace Modules\HumanResources\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;
class Employment extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'profile_id',
        'organization_id',
        'designation_id',
        'employment_type_id',
        'accomplishments', // quantified achievements
        'neighbourhood_id',
        'salary',
        'currency',
        'payment_cycle',
        'started_at',
        'disengaged_at',
        'status',
        'published'
    ];
    protected $attributes =
    [
        'status' => 'Draft',
        'published' => false
    ];

    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }

    public function accomplishments()
    {
        return $this->hasMany(Accomplishment::class);
    }

    public function Organization()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Organization');
    }

    public function Designation()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Designation');
    }
    public function Neighbourhood()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\Neighbourhood');
    }
    public function scopeScheduled($query)
    {
        return $query->with('Designation', 'Neighbourhood', 'Organization', 'Profile')->where('status', 'Scheduled');
    }
    public function scopeActive($query)
    {
        return $query->with('Designation', 'Neighbourhood', 'Organization', 'Profile')->where('status', 'Approved')->where('published', true);
    }
    public function scopeAvailable($query)
    {
        return $query->with('Designation', 'Neighbourhood', 'Organization', 'Profile');
    }
    public function scopeCandidate($query, $profileId)
    {
        return $query->with('Designation', 'Neighbourhood', 'Organization', 'Profile')->where('profile_id', $profileId);
    }
    public function getPeriodAttribute()
    {
        if(is_null($this->disengaged_at))
        {
            return $this->started_at . '- till date';
        }
        return $this->started_at . ' - '. $this->disengaged_at;
    }

    public function getEarningAttribute()
    {
        return $this->currency . ' ' . number_format($this->salary,2);
    }
    public function getAnnualSalaryAttribute()
    {
        return $this->currency . ' ' . number_format($this->salary*12,2);
    }
    public function getCompanyAttribute()
    {
        return $this->Organization->organization_name;
    }
    public function getJobTitleAttribute()
    {
        return $this->Designation->job_role;
    }
    public function getLocationAttribute()
    {
        return $this->Neighbourhood->neighbourhood_name . ' ' . $this->Neighbourhood->City->city_name . ' '. $this->Neighbourhood->City->State->state_name;
    }
    public function getToDateAttribute($value)
    {
        //return Carbon::parse($value)->format('l jS \\of F Y ');
        if(empty($this->disengaged_at))
        {
            return 'Present';
        }
        return Carbon::parse($value)->toDayDateString();
    }

    public function getAchievementsAttribute()
    {
        if(is_null($this->accomplishments))
        {
            return 'N/A';
        }
        return $this->accomplishments;
    }

    public function getFromDateTimeAttribute($value)
    {
        //return Carbon::parse($value)->format('l jS \\of F Y ');
        return Carbon::parse($value)->toDayDateTimeString();
    }

    public function getFromDateAttribute()
    {
        //return Carbon::parse($value)->format('l jS \\of F Y ');
        return Carbon::parse($this->from_datetime)->toFormattedDateString();
    }

    public function getToDateTimeAttribute($value)
    {
//        return Carbon::parse($value)->format('l jS \\of F Y ');
            return Carbon::parse($value)->toDayDateTimeString();
    }
    public function getPayAttribute()
    {
        return $this->currency.' ' . number_format($this->salary,2) . '/'. $this->payment_cycle;
    }

}
