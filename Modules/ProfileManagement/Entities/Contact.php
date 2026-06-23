<?php

namespace Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
protected $fillable=[
'contact_value', //Default, Work, Home, Other
'contact_tag',
'profile_id'

];

protected $attributes =
[
    'contact_tag' => 'Default',
];

    public function ContactType()
    {
    return $this->belongsTo(ContactType::class, 'contact_type');
    }

    public function Profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function Telephones()
    {
        return $this->morphMany('Modules\ContactManagement\Entities\Telephone', 'phoneable');
    }



}
