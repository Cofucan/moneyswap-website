<?php

namespace Modules\CatalogManagement\Entities;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
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
        return Str::limit($this->overview, $limit = 100, $end = '...');
    }


    public function getStatusAttribute()
    {
        if($this->enabled == true)
        {
            return 'Enabled';
        }
        return 'Disabled';
    }
    public function scopeDetails($query, $slug)
    {
        return $query->where('slug', $slug)->first();
    }

    public function scopeActive($query)
    {
        return $query->whereEnabled(true);
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
    public function Programs()
    {
        return $this->hasMany(Program::class);
    }
    public function Campaigns()
    {
        return $this->hasMany('Modules\AppealManagement\Entities\Campaign');
    }
    public function Clients()
    {
        return $this->hasManyThrough('Modules\ClientManagement\Entities\Client', 'Modules\CatalogManagement\Entities\Program');
    }
    public function Pledges()
    {
        return $this->hasManyThrough('Modules\AppealManagement\Entities\Pledge', 'Modules\AppealManagement\Entities\Campaign');
    }

    public function Enquiries()
    {
        return $this->morphMany(Enquiry::class, 'enquiryable');
    }
   

}
