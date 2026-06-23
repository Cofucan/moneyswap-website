<?php

namespace Modules\ProfileManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    protected $fillable = [
        'job_role',
        'tag',
        'division_id',
        'role_id',
        'parent_id',
        'job_description',
        'responsibilities'
            ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->tag = Str::slug($model->job_role);
        });
    }

    public function Staff()
    {
    return $this->hasMany('Modules\ProfileManagement\Entities\Employee');
    }
    public function Parent()
    {
        return $this->belongsTo(Designation::class)->withDefault(['designation'=> 'None']);
    }
    public function Division()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Division');
    }

    public function Role()
    {
        return $this->belongsTo('Modules\RoleManagement\Entities\Role');
    }

  

    public function scopeByRole($query, $role)
    {
        $this->role = trim($role);
        return $query->whereHas('Role', function($q){
            $q->where('slug', $this->role);
        })->first();
    }
    
    public function scopeByTag($query, $role)
    {
        return $query->where('tag', trim($role))->first();
    }
    public function scopeByDivision($query, $division)
    {
        return $query->whereHas('Division', function($q){
            $q->where('slug', $this->role);
        })->first();
    }
    public function scopeByDepartment($query, $department)
    {
        $this->department = trim($department);
        return $query->whereHas('Division.Department', function($q){
            $q->where('slug', $this->department);
        })->first();
    }

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
