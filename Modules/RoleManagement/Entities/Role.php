<?php

namespace Modules\RoleManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Role extends Model
{
    //
    protected $fillable = [
        'label',
        'public_label',
        'slug',
        'default_role',
        'overview',
        'role_id',
        'enabled'
    ];
    protected $attributes =
    [
        'default_role' => '0',
        'enabled' => '1',
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->label);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->label);
        });
      /*   self::deleting(function ($subjectcategory) {
            $subjectcategory->Subjects()->each(function($subject){
                $subject->delete();
            });
        }); */
    }
    public function Department()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Department');
    }

    public function Profiles()
    {
        return $this->hasMany('Modules\ProfileManagement\Entities\Profile');
    }

    public function Employees()
    {
        return $this->hasManyThrough('Modules\EmploymentManagement\Entities\Employee',
        'Modules\EmploymentManagement\Entities\Designation');
    }
    public function Staff()
    {
        return $this->hasManyThrough('Modules\EmploymentManagement\Entities\Employee',
        'Modules\EmploymentManagement\Entities\Designation')->where('employees.published', true);
    }

   public function scopeSelfRegister($query)
   {
    if (Schema::hasColumn('roles', 'self_signup')) {
        $query->where('self_signup', true);
    } elseif (Schema::hasColumn('roles', 'register_self')) {
        $query->where('register_self', true);
    } elseif (Schema::hasColumn('roles', 'self_register')) {
        $query->where('self_register', true);
    }

    if (Schema::hasColumn('roles', 'enabled')) {
        $query->where('enabled', true);
    } elseif (Schema::hasColumn('roles', 'published')) {
        $query->where('published', true);
    }

    return $query;
   }
public function scopeActive($query)
    {
        if (Schema::hasColumn('roles', 'published')) {
            return $query->where('published', true);
        }

        if (Schema::hasColumn('roles', 'enabled')) {
            return $query->where('enabled', true);
        }

        return $query;
    }
}
