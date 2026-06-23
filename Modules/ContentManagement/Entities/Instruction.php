<?php

namespace Modules\ContentManagement\Entities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    //
    protected $fillable = [
        'headline',
        'body',
        'tag',
        'slug',
        'parent_id',
        'user_id',
        'display_image',
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
        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->slug = Str::slug($model->headline);
            $model->tag = Str::slug($model->tag);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->headline);
        });
    }

    public function getRouteKeyName()
    {
        return 'tag';
    }

    public function scopeByTag($query, $tag)
    {
        return $query->where('tag', $tag)->first();
    }
    public function scopePage($query, $tag)
    {
        return $query->where('tag', $tag)->first();
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
