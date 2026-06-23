<?php

namespace Modules\MediaManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;
use Auth;

class Attachment extends Model
{
    //
    const DURATION = '45';
    protected $fillable = [
        'attachable_type',
        'attachable_id',
        'slug',
        'file_name',
        'overview',
        'media_type',
        'thumbnail',
        'media_url',
        'user_id',
        'status',
        'published'
    ];
    protected $attributes =[
        'published' => true,
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->file_name);
            //$model->user_id = Auth::user()->id;
        });
    }

    public function attachable()
    {
    return $this->morphTo();
    }

    public function getVideoHtmlAttribute()
    {
        $embed = Embed::make($this->media_url)->parseUrl();

        if (!$embed)
            return '';
        $embed->setAttribute(['width' => 400]);
        return $embed->getHtml();
    }

    public function User()
    {
        return $this->belongsTo('App/Models/User');
    }
}
