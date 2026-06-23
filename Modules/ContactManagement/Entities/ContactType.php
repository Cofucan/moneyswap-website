<?php

namespace Modules\ContactManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    //
protected $fillable = [
    'contact_type'
];

public function Contacts()
{
return $this->hasMany(Contact::class);
}
}
 