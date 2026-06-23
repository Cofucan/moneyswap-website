<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;
use Illuminate\Support\Str;
class Brief extends Model
{
    //
    protected $fillable =
    [
        'contact_name',
        'email',
        'telephone',
        'device_ip',
        'expertise_id',             
        'slug',
        'subject',
        'overview',
        'user_id',
        'created_at',
        'status',
    ];
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->brief_subject);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->brief_subject);
        });
    }

    protected $attributes =
    [
        'status' => 'New',

    ];

    public function Enquiryable()
    {
        return $this->morphTo();
    }

    public function Neighbourhood(){
        return $this->belongsTo(Neighbourhood::class);
    }
    public function Expertise()
    {
        return $this->belongsTo(Expertise::class);
    } 

    public function scopeActive($query)
    {
        return $query->whereEnabled(true);
    }

    public function getDateCreatedAttribute($value)
    {
      return Carbon::parse($this->created_at)->toFormattedDateString();
    } 
}
