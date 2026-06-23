<?php

namespace Modules\OrganizationManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Corevalue extends Model
{
    //
    protected $fillable =[       
        'organization_id', 
        'value_title',
        'summary',
        'display_image',       
        'display_order',
        'published'
    ];

    
    protected $attributes =[
        'published' => true
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            //$model->slug = str_slug($model->label);
            $model->display_order = Corevalue::max('display_order')+1;
    
        });
        
    }   
    public function Organization(){
        return $this->belongsTo(Organization::class)->withDefault();
    }
}
 