<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Enquiry extends Model
{
    //
    protected $fillable =
    [
        'contact_name',    
        'email',
        'telephone',
        'enquiryable_id',
        'enquiryable_type',
        'enquiry_device_ip',
        'enquiry_title',
        'slug',
        'enquiry_body',
        'user_id',
        'status',
    ]; 
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {           
            $model->slug = Str::slug($model->enquiry_title);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->enquiry_title);
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
}
