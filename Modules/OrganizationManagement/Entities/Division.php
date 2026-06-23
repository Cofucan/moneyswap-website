<?php

namespace Modules\OrganizationManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //
    protected $fillable = [
        'label',
        'slug',
        'department_id',
        'overview',
        'practitioner',
        'icon',
        'display_image',
        'is_default',
        'published'
        ];

        public static function boot()
        {
            parent::boot();
            static::saving(function ($model) {
                $model->slug = Str::slug($model->label);
            });
            static::updating(function ($model) {
                $model->slug = Str::slug($model->label);
            });
        }

    public function Designations()
    {
        return $this->hasMany ('Modules\HumanResources\Entities\Designation');
    }

    public function Vacancies()
    {
        return $this->hasManyThrough('Modules\RecruitmentManagement\Entities\Vacancy',
        'Modules\HumanResources\Entities\Designation');
    }
    public function OpenJobs()
    {
        return $this->hasManyThrough('Modules\RecruitmentManagement\Entities\Vacancy', 'Modules\HumanResources\Entities\Designation')->where('vacancies.published', true)->orderBy('date_approved', 'Desc');
    }

    public function Specializations()
    {
        return $this->hasManyThrough('Modules\EmploymentManagement\Entities\Specialization', 'Modules\EmploymentManagement\Entities\Designation');
    }

    public function Department()
    {
        return $this->belongsTo(Department::class);
    }
    public function getSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 65, $end = '...');
    }
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
