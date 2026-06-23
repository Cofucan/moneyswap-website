<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class EmploymentType extends Model
{
    //
    protected $fillable = [
        'label',
        'tag',
        'slug',
        'description',
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
        return $query->whereIsActive(true);
    }
    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }

   
   
    public function scopeByTag($query, $tag)
    {
        return $query->where('tag', trim($tag))->first();
    }
}
