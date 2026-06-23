<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    protected $fillable = [
        'job_role',
        'tag',
        'role_id',
        'parent_id',
        'job_description'
            ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->tag = Str::slug($model->job_role);
        });
    }
    public function Employees()
    {
    return $this->hasMany('Modules\HumanResources\Entities\Employee')->where('is_active', true);
    }

    public function Staff()
    {
    return $this->hasMany('Modules\HumanResources\Entities\Employee');
    }

    public function Role()
    {
        return $this->belongsTo('Modules\RoleManagement\Entities\Role');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
