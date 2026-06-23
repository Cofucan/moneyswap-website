<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class EmploymentStage extends Model
{
    //
    protected $fillable = [
        'label',
        'tag',
        'slug',
        'overview',
        'published'
    ];
    protected $attributes =
    [
        'published' => true,
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

    public function scopeActive($query)
    {
        return $query->wherePublished(true);
    }
    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function Designations()
    {
        return $this->hasManyThrough('Modules\HumanResources\Entities\Designation', Employee::class);
    }

    public function Vacancies()
    {
        return $this->hasMany('Modules\RecruitmentManagement\Entities\Vacancy');
    }
    
    public function Applications()
    {
        return $this->hasManyThrough('Modules\RecruitmentManagement\Entities\Application',
         'Modules\RecruitmentManagement\Entities\Vacancy');
    }
    public function scopeByTag($query, $tag)
    {
        return $query->where('tag', trim($tag))->first();
    }
}
