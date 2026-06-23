<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    protected $fillable =[
        'expertise_id',
        'reviewer_name',
        'reviewer_identity',
        'status',
        'label',
        'testimony',
        'display_image',
        'rankweight',
        'published'
    ];


    public function Expertise()
    {
        return $this->belongsTo('Modules\CatalogManagement\Entities\Expertise');
    }

    public function getActiveAttribute()
    {
        if($this->enabled == true)
        {
            return 'Enabled';
        }
        return 'Disabled';
    }

    public function scopeActive($query)
    {
        return $query->wherePublished(true);
    }
    public function getServiceNameAttribute()
    {
        return $this->Expertise->label;
    }

}