<?php

namespace Modules\ContactManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
protected $fillable=[
'first_name',
'last_name', 
'telephone',
'email',
'organization_id'

];

    protected $attributes =
    [
        // 'contact_tag' => 'Default',
    ];

    public function getFullNameAttribute()
    {
        return $this->last_name. ' '. $this->first_name;
    }

    public function getCompanyNameAttribute()
    {
        if(is_null($this->organization_id))
        {
            return 'N/A';
        }
        return $this->Organization->legal_name;
    }

    public function Organization()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Organization');
    }


}
