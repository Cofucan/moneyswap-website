<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Carbon\carbon;

class Resume extends Model
{
    //use HasMediaTrait;
    // protected $connection = 'skoojobs';
    protected $fillable = [
        'reference_code',
        'profile_id',
        'designation_id',
        'education_id',
        'employment_type_id',
        'city_id',
        'trcn_number',
        'experience_years',
        'career_objective',
        'keywords',
        'published_date',
        'availability',
        'boosted',
        'enable_analytics',
        'template',
        'visibility',    //Private, Public, Recruiter
        'is_complete'
    ];

    protected $attributes =
    [
        'visits' => '0',
        'published' => false,
        'status' => 'Draft',
        'enable_analytics' => false
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            //$model->user_id = Auth::user()->id;
            $model->reference_code = $model->profile_id.'-'.time();
        });

        static::deleting(function($model) { // before delete() method call this

       });
    }
    public function getRouteKeyName()
    {
        return 'reference_code';
    }
    public function getQualificationAttribute()
    {
        return $this->profile->educations->last()->title;
    }
    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }
    public function getExperienceYearsAttribute()
    {

    }

    public function EmploymentType()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\EmploymentType');
    }

    public function Education()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Education');
    }

    public function Designation()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Designation');
    }
    public function City()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\City');
    }
    public function Specializations()
    {
        return $this->belongsToMany('Modules\HumanResources\Entities\Specialization')
        ->withPivot('experience_years', 'published')
        ->withTimestamps();;
    }

    public function Applications()
    {
        return $this->hasMany('Modules\HumanResources\Entities\Application');
    }
    // public function Employments()
    // {
    //     return $this->hasManyThrough(Employment::class, 'Modules\ProfileManagement\Entities\Profile');
    // }

    public function scopeApproved($query)
    {
        return $query->where('status', 'Approved');
    }

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }

    public function Boosted()
    {
        //return $this-boosted->where('status', 'Approved');
    }
}
