<?php

namespace Modules\CatalogManagement\Entities;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    //
    protected $fillable = [
        'label',
        'overview',
        'thumbnail',
        'display_image',
        'slug',
        'display_order',
        'enabled',
        'featured',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $attributes =
    [
        'enabled' => true
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

    public function getSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 120, $end = '...');
    }


    public function getBriefAttribute()
    {
        return Str::limit($this->overview, $limit = 300, $end = '...');
    }


    public function getStatusAttribute()
    {
        if($this->enabled == true)
        {
            return 'Enabled';
        }
        return 'Disabled';
    }

    public function Videos()
    {
        return $this->morphMany('Modules\ContentManagement\Entities\Video', 'owner');
    }

    public function Albums()
    {
        return $this->morphMany(Album::class, 'galleryable');
    }

    public function Briefs()
    {
        return $this->hasMany(Brief::class);
    }
    public function Causes()
    {
        return $this->hasMany('Modules\ProjectManagement\Entities\Cause');
    }

    public function Enquiries()
    {
        return $this->morphMany(Enquiry::class, 'enquiryable');
    }

    public function scopeActive($query)
    {
        return $query->whereEnabled(true);
    }
   
}
