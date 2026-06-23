<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Auth;
use Carbon\carbon;
class Album extends Model
{
    //
    protected $fillable = [
    'display_image',
    'slug',
    'label',
    'overview',
    'user_id',
    'published'
];

    protected $attributes = [
        //'status' => 'Pending',
        'published' => true,
        ];
        public static function boot()
        {
            parent::boot();
            static::creating(function ($model) {
                $model->slug = Str::slug($model->label). date('Y-m-d', strtotime(carbon::today()));
                $model->user_id = Auth::id();
            });
            // static::updating(function ($model) {
            //     $model->slug = Str::slug($model->label). date('Y-m-d', strtotime(carbon::today()));
            // });
            self::deleting(function ($album) {
                $album->Photos()->each(function($photo){
                    $photo->delete();
                });
            });
        }
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function Photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function DP()
    {
        return $this->hasOne(Photo::class);
    }

    public function scopeActive($query)
    {
        return $query->has('Photos');
    }

    public function Videos()
    {
        return $this->morphMany(Video::class, 'owner');
    }

    public function scopeOffline($query)
    {
        return $query->where('published', false);
    }

    public function getCoverAttribute()
    {
        if(is_null($this->display_image))
        {
            return 'img/placeholder.jpg';
        }
        return $this->display_image;
    }
    public function getThumbAttribute()
    {
        if(is_null($this->display_image))
        {
            return 'img/placeholder.jpg';
        }
        return $this->thumbnail;
    }
}
