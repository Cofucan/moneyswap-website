<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;
use Auth;

class Video extends Model
{
    //
    protected $fillable = [
        'label',
        'slug',
        'owner_type',
        'owner_id',
        'link',
        'published'      
    ]; 

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->label);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->label);
        });
    }

    protected $attributes =[
        'published' => true,
    ];

    

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function owner()
    {
    return $this->morphTo();
    }

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
