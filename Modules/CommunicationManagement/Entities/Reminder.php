<?php

namespace Modules\CalendarManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;
use Auth;

class Reminder extends Model
{
    //
    const DURATION = '45';
    protected $fillable = [
        'remindable_type',
        'remindable_id',
        'slug',
        'user_id',
        'label',
        'due_at',
        'days_before',
        'days_after',
        'intervals',
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

    public function remindable()
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
