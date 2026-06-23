<?php

namespace Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class ProfileAddress extends Model
{
    //
protected $fillable=[
    'address_id', 
    'address_type',//Work, Home
    'profile_id',
    'date_from',
    'date_to',
    'enabled',
];

    protected $attributes =
    [
        'enabled' => true,
    ];

    public function getFullLocationAttribute()
    {
        return $this->Address->full_address;
    }

    public function Profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function Address()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\Address');
    }



}
