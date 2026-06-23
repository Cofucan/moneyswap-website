<?php

namespace Modules\ClientManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
class ClientCategory extends Model
{
    //
    // use HasFactory, Hashidable;
    protected $fillable = [
        'label',
        'overview',
        'enabled'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $attributes = [
        'enabled' => true
        ];
    public function Registrations()
    {
        return $this->hasMany('Modules\RegistrationManagement\Entities\Registration');
    }
    public function Clients()
    {
        return $this->hasMany('Modules\OrphanManagement\Entities\Client')->where('clients.enabled', true);
    }

    public function History()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client');
    }
    public function AllStudents()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client');
    }
    public function scopeActive($query)
    {
        return $query->where('enabled', true);
    }
    public function Fees()
    {
        return $this->hasManyThrough('Modules\FeeManagement\Entities\Fee',
        'Modules\FeeManagement\Entities\FeeSchedule');
    }
    public function scopeByLabel($query, $student_type)
    {
        return $query->where('student_type', $student_type)->first();
    }
}
