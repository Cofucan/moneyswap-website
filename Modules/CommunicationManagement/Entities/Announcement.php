<?php

namespace Modules\CommunicationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\carbon;
use App\Models\User;
class Announcement extends Model
{
    //
    protected $fillable = [
        'subject',
        'slug',
        'academic_term_id',
        'body',
        'publish_at',
        'excerpt',
        'page_views',
        'published'
    ];

    protected $attributes =
    [
        'published' => '0',
        'page_views' => '0',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->slug = Str::slug($model->subject);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->subject);
        });
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(200)
              ->height(200)
              ->sharpen(10);

        $this->addMediaConversion('square')
              ->width(412)
              ->height(412)
              ->sharpen(10);
    }
    public function scopeActive($query)
    {
        return $query->wherePublished(true);
    }
    public function getPublishDateAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo('App/Models/User');
    }
    public function Recipients()
    {
        return $this->belongsToMany('App/Models/User')
        ->withPivot('read_date');
    }
    public function AcademicTerm()
    {
        return $this->belongsTo('Modules\CalendarManagement\Entities\AcademicTerm');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function getSummaryAttribute(){
        return Str::limit($this->body, $limit = 80, $end = '...');
    }

}
