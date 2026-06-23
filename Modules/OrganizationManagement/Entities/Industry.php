<?php

namespace  Modules\OrganizationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Industry extends Model
{
    //
    protected $fillable = [
        'label',
        'icon',
        'overview',
        'display_image',
        'thumbnail',
        'enabled',
        'slug'
    ];
    protected $attributes =
    [
        'enabled' => true,
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
    public function Organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function Expertises()
    {
        return $this->hasMany('Modules\ContentManagement\Entities\Expertise')->withDefault();
    }
    public function scopeActive($query)
    {
        return $query->where('enabled', true);
    }

    public function getShortSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 100, $end = '...');
    }

    public function getHighSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 200, $end = '...');
    }
}
