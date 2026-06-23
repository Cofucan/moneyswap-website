<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $fillable = [
        'person_id',
        'skillset_id',
        'proficiency',
        'status' //Draft, Published, Verified, Unpublished
    ];

    public function Person()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Person');
    }
}
