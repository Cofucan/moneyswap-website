<?php

namespace Modules\ClientManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    //
    protected $fillable = [
        'profile_id',
        'orphan_id',
        'relationship_id',
        'expired_at',
        'deceased_cause',
        'status',
        'enabled'
    ];
    protected $attributes =
    [
        'enabled' => true
    ];
    public function Relationship()
    {
        return $this->belongTo(Relationship::class);
    }
    public function Client()
    {
        return $this->belongTo('Modules\ClientManagement\Entities\Client');
    }
    public function Profile()
    {
        return $this->belongTo('Modules\ProfileManagement\Entities\Person');
    }
    public function ScopeAvailable($query)
    {
        return $query->with('Profile', 'Client', 'Relationship');
    }
}
