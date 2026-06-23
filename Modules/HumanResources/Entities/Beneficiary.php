<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class Beneficiary extends Model
{

    use HasFactory, Hashidable;
    protected $fillable = [
        'profile_id',      
        'cause_id',
        'remarks',     
        'city_id',
        'status',
        'enabled'
    ];
    protected $casts = [
        'enabled' => 'boolean',
    ];


    public static function boot()
    {
        parent::boot();
        // static::creating(function ($model) {
        //     $model->enabled = false;
        //     $model->status = 'Pending';  
        // });       
     
    }
    // public function getCurrencyCodeAttribute()
    // {
    //     return $this->Currency->code;
    // }
      
    public function getServiceAttribute()
    {
        return $this->Cause->label;
    }
    public function getLocationAttribute()
    {
        return $this->City->area;
    }

    public function getFullNameAttribute()
    {
        return $this->Profile->full_name;
    }

    public function User()
    {
        return $this->belongsTo('App\Modules\User');
    }
    public function Cause()
    {
       return $this->belongsTo('Modules\ProjectManagement\Entities\Cause');
    }
    
    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }

    public function City()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\City');
    }

    public function scopeActive($query)
    {
        return $query->whereEnabled(true);
    }
}
