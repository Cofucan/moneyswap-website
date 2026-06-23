<?php

namespace Modules\OrganizationManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    //
    protected $fillable =[
        'organization_id',
        'outlet_code',
        'label',
        'outlet_type',
        'telephone',
        'address_prefix',
        'building_number',
        'street_name',
        'city_id',
        'published'
    ];

    public function Organization()
    {
        return $this->belongsTo(Organization::class)->withDefault();
    }

    public function City()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\City')->withDefault();
    }

    public function Galleries()
    {
        return $this->morphMany('Modules\ContentManagement\Entities\Gallery', 'galleryable');
    }

    
    public function Applications()
    {
        return $this->hasMany(Application::class);
    }

    public function Registrations()
    {
        return $this->hasMany(Registrations::class);
    }

    public function Contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
    // public function getAddressAttribute(){

    //     return "{$this->address_prefix} {$this->building_number} {$this->street_name}, {$this->Neighbourhood->neighbourhood_name}, {$this->Neighbourhood->City->city_name} ,{$this->Neighbourhood->City->State->state_name}";

    // }

    public function getAddressAttribute(){
        $city = !empty($this->City->city_name) ? $this->City->city_name : $this->City->area;
        return trim("{$this->address_prefix} {$this->building_number} {$this->street_name}, {$city}");

    }

    public function getCountryCodeAttribute()
    {
        return $this->City->State->Country->code;
    }
    public function scopeMain($query)
    {
        return $query->where('outlet_tag', 'Main');
    }

    public function scopeActive($query)
    {
        return $query->wherePublished(true);
    }

}
