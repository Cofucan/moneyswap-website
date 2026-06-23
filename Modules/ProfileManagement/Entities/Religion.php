<?php

namespace Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    //
protected $fillable = [
    'label',
    'worshiper',
    'overview',
    'enabled'
];

public function Profiles()
{
    return $this->hasMany(Profile::class);
}
public function Clients()
{
    return $this->hasMany('Modules\OrphanManagement\Entities\Client');
}
public function scopeActive($query)
{
    return $query->whereEnabled(true);
}
}
