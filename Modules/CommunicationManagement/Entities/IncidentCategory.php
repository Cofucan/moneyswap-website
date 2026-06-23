<?php

namespace Modules\CommunicationManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'overview',
        'icon',
        'published'
    ];

    public function Incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
