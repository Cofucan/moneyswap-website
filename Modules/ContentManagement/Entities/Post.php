<?php

namespace Modules\ContentManagement\Entities;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
// use Cohensive\Embed\Facades\Embed;

class Post extends Model
{
    //
    protected $fillable = [
        'headline',
        'story',
        'thumbnail',
        'display_media',
        'video',
        'published',
        'slug',
        'allow_comment',
        'user_id',
        'post_source',
        'status', // Draft, Scheduled, Approved, Rejected, Archieved
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
            $model->slug = Str::slug($model->headline)."-".time();
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->headline)."-".time();
        });
    }
    public function scopePopular($query)
    {
        // By defining the conditions to be a popular book,
        // it's easy to change them later on for all queries at once
        return $query->whereHas('votes', '>=', 10);
    }

    public function scopeActive($query, $value)
    {
        return $query->where('published', $value);
    }

    public function scopeCreatedAfter($query, $date)
    {
        // A scope can be dynamic and accept parameters
        return $query->where('created_at', '>', $date);
    }

    public function getDatePublishedAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
        //return
    }

    public function getSummaryAttribute()
    {
        return Str::limit($this->story, $limit = 100, $end = '...');
    }

    public function user()
    {
        return $this->belongsTo('App/Models/User');
    }

    public function comments()
    {
        return $this->morphMany('Modules\CommunicationManagement\Entities\Comment', 'commentable')->whereNull('parent_id');
    }

 
    public function Classifications()
    {
        return $this->belongsToMany(Classification::class)->withTimestamps();
    }


}
