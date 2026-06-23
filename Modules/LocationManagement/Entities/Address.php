<?php

namespace Modules\LocationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\carbon;
class Address extends Model
{
    //
protected $fillable = [
    'label',
    'address_prefix',
    'building_no',
    'street_name',
    'neighbourhood_id',
    'status',
    'enabled',
    'user_id',
    'longitude',
    'latitude'

];

protected $attributes =
    [
         'status' => 'Unverified',
        'enabled' => true
    ];

    public static function boot()
    {
        parent::boot();
         static::saving(function ($model) {
            $model->user_id = Auth::user()->id;
         });
        /* static::updating(function ($model) {
            $model->slug = str_slug($model->headline);
        }); */
    }

public function getStreetAddressAttribute()
{
    return "{$this->address_prefix} {$this->building_no} {$this->street_name}";
}

public function getFullAddressAttribute()
{
    return "{$this->address_prefix} {$this->building_no} {$this->street_name}, {$this->Neighbourhood->neighbourhood_name}
    {$this->Neighbourhood->City->city_name}, {$this->Neighbourhood->City->State->Country->label}";
}

public function Neighbourhood()
{
return $this->belongsTo(Neighbourhood::class);
}



public function Profiles()
{
    return $this->hasMany('Modules\ProfileManagement\Entities\Profile');
}

public function MedicalContacts()
{
    return $this->hasMany('Modules\HealthManagement\Entities\MedicalContact');
}

public function Events()
{
return $this->hasMany('(Modules\CalendarManagement\Entities\Event');
}


public function Organizations()
{
    return $this->belongsToMany('Modules\ClientManagement\Entities\Organization')
                ->withPivot('outlet_code', 'outlet_tag')
                ->withTimestamps();
}

}
