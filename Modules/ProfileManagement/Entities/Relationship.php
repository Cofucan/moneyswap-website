<?php

namespace Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Relationship extends Model
{
    //
protected $fillable = [
    'label',
    'overview',
    'enabled'
];

public function Kindreds()
{
    return $this->hasMany('Modules\ClientManagement\Entities\Kindred');
}
public function Clients()
{
    return $this->hasMany('Modules\ClientManagement\Entities\Client');
}
public function ScopeActive($query)
{
    return $query->where('enabled', true);
}
public function scopePossible($query)
{
    $this->user_id = Auth::id();
    return $query->where('enabled', true)->doesnthave('Kindreds')->whereHas('Kindreds', function($item){
        $item->where('user_id', $this->user_id);
        })->orderBy('label', 'Desc');;
}
}
