<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
//class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'profile_id',
        'change_password',
        'client_ip',
        'enabled',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'enabled' => 'boolean',
    ];

    public function Secret()
    {
        return $this->hasOne(Secret::class);
    }
    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }
    public function Addresses()
    {
        return $this->hasMany('Modules\LocationManagement\Entities\Address');
    }
    public function Wallets()
    {
        return $this->hasManyThrough(Cause::class, Profile::class);
    }
    public function Cause()
    {
        return $this->hasManyThrough(Cause::class, Profile::class)->where('causes.main', true)->latest();
    }



}
