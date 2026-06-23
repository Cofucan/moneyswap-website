<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
        'article_subject',
        'slug',
        'guideline_id',
        'article_body',
        'publish_date',
        'excerpt',
        'page_views',
        'published'
    ];

    protected $attributes =
    [
        'published' => '0',
        'page_views' => '0',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->slug = Str::slug($model->headline);
            $model->excerpt = Str::limit($model->body, $limit = 295, $end = '...');
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->headline);
        });
    }
}
