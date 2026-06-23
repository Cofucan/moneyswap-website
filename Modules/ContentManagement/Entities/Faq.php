<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Faq extends Model
{
    //
    protected $fillable = [
    'question',
    'faq_category_id',
    'answer',
    'user_id',
    'slug',
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
                $model->slug =  Str::slug($model->question);
            });
            static::updating(function ($model) {
                $model->slug =  Str::slug($model->question);
            });

        }

    public function FaqCategory()
    {
        return $this->belongsTo(FaqCategory::class)->withDefault('None');
    }

    public function scopeCategory($query, $categoryId)
    {
        return $query->where('faq_category_id', $categoryId);
    }

    public function getSummaryAttribute()
    {
        return Str::limit($this->answer, $limit = 100, $end = '...');
    }
    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
    public function scopeAvailable($query)
    {
        return $query->with('FaqCategory');
    }

}
