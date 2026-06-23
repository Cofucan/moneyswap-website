<?php

namespace  Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    //
    protected $fillable = [
        'person_id',
        'relationship_id',
        'related_person_id',
        'priority'
    ];
    
    public function Relationship()
    {
        return $this->hasMany(Relationship::class);
    }
    public function Person()
    {
        return $this->hasMany('Modules\ProfileManagement\Entities\Person');
    }
    public function Relation()
    {
        return $this->hasMany('Modules\ProfileManagement\Entities\Person', 'related_person_id');
    }
}
