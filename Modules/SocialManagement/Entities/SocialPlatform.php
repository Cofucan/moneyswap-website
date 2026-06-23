<?php

namespace Modules\SocialManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class SocialPlatform extends Model
{
    //
    protected $fillable = [
        'platform_name',
        'url',
        'icon',
        
        'published'
    ];
    protected $attributes =
    [
        'published' => '1',
    ];
        public function SocialHandles()
        {
        return $this->hasMany(SocialHandle::class);
        }

    
}
