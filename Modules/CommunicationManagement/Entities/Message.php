<?php

namespace Modules\CommunicationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use App\Models\User;

class Message extends Model
{
    //
    protected $fillable = [
        'thread_id',
        'body',
        'published',
        'slug',
        'allow_comment',
        'status', //Draft, Sent, Archived
        'user_id',
        'date_published'
    ];

    public static function boot()
    {
        parent::boot();
        /* static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('published', 1);
        }); */
        static::saving(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->slug = Str::slug($model->message_subject);            
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->message_subject);
        });
    }
    public function User()
    {
        return $this->belongsTo('App/Models/User');
    }
    public function Conversations()
    {
        return $this->hasMany(Conversation::class)->whereNull('parent_id');
    }

    public function Profiles()
    {
        return $this->belongsToMany('App/Models/User')
        ->withPivot('read_date', 'email', 'status')
        ->withTimestamps();
    }
    
    public function ReadMessages()
    {
        return $this->belongsToMany('App/Models/User')
        ->withPivot('read_date', 'email', 'status')
                        ->wherePivot('status', 'read');
    }
}
 