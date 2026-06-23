<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    //
    protected $fillable = [
        'post_type'
    ];

    public function Posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
