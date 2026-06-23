<?php

namespace Modules\LocationManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    // public $incrementing = false;
    // public $primaryKey = 'currency_code';
    protected $fillable = [
        'country_code',
        'country_name',
        'citizenship_title'
    ];

public function Profiles()
{
    return $this->hasMany('Modules\ProfileManagement\Entities\Profile')->withDefault();
}
 
public function States()
{
    return $this->hasMany('Modules\EnrolmentManagement\Entities\Enrolment');
}

public function Cities()
{
    return $this->hasManyThrough(City::class, State::class);
}

public function Currency()
{
    return $this->hasOne(Currency::class, 'currency_code');
}

public function scopeActive($query)
    {
        return $query->where('enabled', true);
    }
}
