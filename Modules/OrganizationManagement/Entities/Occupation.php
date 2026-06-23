<?php

namespace Modules\OrganizationManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    //
    protected $fillable = [
        'label',
        'slug',
        'industry_id',
        'overview',
        'practitioner',
        'icon',
        'display_image',
        'is_default',
        'enabled'
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

   

    public function Industry()
    {
        return $this->belongsTo(Industry::class);
    }
    public function getSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 65, $end = '...');
    }
    public function scopeenabled($query)
    {
        return $query->where('enabled', true);
    }
}
