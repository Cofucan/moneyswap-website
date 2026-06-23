<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use Illuminate\Support\Str;

class Guideline extends Model
{
     //
     protected $fillable = [
        'label',
        'overview',
        'tag',
        'guideline_excerpt',
        'slug',
        'organization_id',
        'user_id',
        'enabled'
    ];

    protected $attributes =
    [
        'enabled' => false,
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
           $model->user_id = Auth::user()->id;
           $model->slug = Str::slug($model->label);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->label);
        });
    }
    public function scopeActive($query)
    {
        return $query->where('enabled', true);
    }

}
