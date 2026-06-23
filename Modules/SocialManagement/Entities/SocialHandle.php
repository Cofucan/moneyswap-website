<?php

namespace Modules\SocialManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class SocialHandle extends Model
{
    //
    protected $fillable = [
        'social_platform_id',
        'handle_name',
        'organization_id',
        'published'
    ];
    protected $attributes =
    [
        'published' => '1',
    ];
   
    public function SocialPlatform(){
        return $this->belongsTo(SocialPlatform::class);
    }

   
}
