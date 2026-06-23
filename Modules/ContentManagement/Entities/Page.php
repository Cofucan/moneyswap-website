<?php

namespace Modules\ContentManagement\Entities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable = [
        'headline',
        'body',
        'page_tag',
        'slug',
        'parent_id',
        'user_id',
        'display_image',
        'show_thumbnail',
        'thumbnail',
        'page_button',
        'button_link',
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
            $model->user_id = Auth::user()->id;
            $model->slug = Str::slug($model->headline);
            $model->page_tag = Str::slug($model->page_tag);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->headline);
        });
    }

    public function getRouteKeyName()
    {
        return 'page_tag';
    }

    public function scopeByTag($query, $tag)
    {
        return $query->where('page_tag', $tag)->first();
    }
    public function scopeDetails($query, $tag)
    {
        return $query->where('page_tag', $tag)->first();
    }

    public function getSummaryAttribute()
    {
        return Str::limit($this->body, $limit = 900, $end = '...');
    }


    public function Galleries()
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }
}
