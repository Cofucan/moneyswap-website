<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    //
    protected $fillable = [
        'label',
        'published'
        ] ;
    public function Posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
