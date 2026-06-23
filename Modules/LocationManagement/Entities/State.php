<?php

namespace Modules\LocationManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $fillable = [
        'country_id',
        'state_code',
        'state_name',
        'attraction',
        'longitude',
        'latitude',
        'state_symbol',
        'population_estimate',
        'about_state',
        'status'
    ]; 

   
    // define relationships

	public function Cities()
    {
        return $this->hasMany(City::class);
    }
    /**
     * Get all of the cities in the state.
     */
    public function Neighbourhoods()
    {
        return $this->hasManyThrough(Neighbourhood::class, City::class);
    
    }public function Country()
    {
        return $this->belongsTo(Country::class);
    }
    

}
