<?php

namespace Modules\CommunicationManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'user_id ',
        'parent_id',
        'commentable_type',
        'commentable_id',
        'comment_body',   
        'made_at',
        'published'
    ];

      
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });       
    }

    protected $attributes =
    [
        'published' => true,

    ];

    public function user()
    {
        return $this->belongsTo('App/Models/User');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function commentable()
    {
    return $this->morphTo();
    }
    
    public function Parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class)->with('parent');
    }

    public function getCreatorAttribute()
    {
        return $this->User->Profile->full_name;
    }
}
