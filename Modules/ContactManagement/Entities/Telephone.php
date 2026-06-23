<?php

namespace Modules\ContactManagement\Entities;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    protected $fillable = [
        'phone_tag',
        'phoneable_id',
        'phoneable_type',
        'phone_number',
        'verified_at',
        'user_id',
        'status', //Pending, Verified, Invalid, AwaitingOTP
        'enabled'
    ];
    protected $casts = [
        'enabled' => 'boolean',
    ];
    protected $attributes = [
        'enabled' => false,
    ];
        public static function boot()
        {
            parent::boot();
            static::creating(function ($model) {
                $model->status = 'Pending';
                $model->phone_tag = 'Default';
            });
        }

    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }
    public function phoneable()
    {
        return $this->morphTo();
    }
}
