<?php

namespace Modules\LocationManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Neighbourhood extends Model
{
    //
	protected $fillable = [
        'population_estimate',
        'neighbourhood_name',
        'about_neighbourhood',
        'longitude',
        'latitude',
        'postal_code',
        'city_id',
        'published'

       ];
       protected $attributes =
       [
           'published' => '1'   
       ];
       
       public function City()
       {
           return $this->belongsTo(City::class);
       }


       public function Addresses()
       {
           return $this->hasMany(Address::class);
       }

       public function Outlets()
       {
           return $this->hasMany('Modules\SchoolManagement\Entities\Outlet');
       }

       
       public function Fare()
       {
           return $this->morphOne('Modules\FeeManagement\Entities\Fee', 'feeable');
       }

       public function getAreaAttribute()
       {
           return "{$this->neighbourhood_name}, {$this->City->city_name}, {$this->City->State->state_name}.";
       }

       public function getCityAreaAttribute()
       {
           return "{$this->neighbourhood_name}, {$this->City->city_name}";
       }
}
