<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Advantage extends Model
{
    //
    protected $fillable =[
        'software_id',
        'for_whom',
        'label',
        'overview',
        'display_image',
        'sequence',
        'published'
    ];


    protected $attributes =[
        'published' => true
    ];

    public function getStatusAttribute()
    {
        if($this->published == true)
        {
        return 'Enabled';
        }
       
        return 'Disabled';
      
    }

   
    public function scopeActive($query)
    {
        return $query->where('published', true)->orderBy('sequence', 'ASC');
    }
    public function scopeMembers($query)
    {
        return $query->where('for_whom', 'Members')->wherePublished(true)->orderBy('sequence', 'ASC');
    }
    public function scopeGeneral($query)
    {
        return $query->where('for_whom', 'General')->wherePublished(true)->orderBy('sequence', 'ASC');
    }
}
