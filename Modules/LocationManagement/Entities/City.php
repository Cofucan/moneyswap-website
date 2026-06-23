<?php

namespace Modules\LocationManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = [
        'city_name',
        'city_code',
        'about_city',
        'state_id',
        'population_estimate',
        'longitude',
        'latitude',
        'status'
        ] ;
     // define relationship
    public function State ()
    {
        return $this->belongsTo(State::class);
    }

    public function Neighbourhoods()
    {
        return $this->hasMany(Neighbourhood::class);
    }

    public function Addresses()
    {
    	return $this->hasManyThrough(Address::class, Neighbourhood::class);
    }

    public function getAreaAttribute()
    {
        return $this->city_name. ', '. $this->State->state_name. ', ' . $this->State->Country->label;
    }
}
