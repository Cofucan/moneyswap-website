<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HowItWorkGroup extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'display_order',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'display_order' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function howItWorks()
    {
        return $this->belongsToMany(
            HowItWork::class,
            'how_it_work_group_items',
            'how_it_work_group_id',
            'how_it_work_id'
        )->withPivot('display_order', 'is_enabled')->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
