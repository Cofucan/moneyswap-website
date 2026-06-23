<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FaqCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'overview',
        'slug',
        'icon',
        'published'

    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug =  Str::slug($model->label);
        });
        static::updating(function ($model) {
            $model->slug =  Str::slug($model->label);
        });

    }

    public function Faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function ActiveFaqs()
    {
        return $this->hasMany(Faq::class)->where('faq.published', true);
    }

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
