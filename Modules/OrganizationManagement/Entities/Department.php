<?php

namespace Modules\OrganizationManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = [
        'label',
        'slug',
        'overview',
        'published'
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->label);
        });
      /*   self::deleting(function ($subjectcategory) {
            $subjectcategory->Subjects()->each(function($subject){
                $subject->delete();
            });
        }); */
    }

    public function Employees()
    {
        return $this->hasManyThrough('Modules\EmploymentManagement\Entities\Employee',
        'Modules\EmploymentManagement\Entities\Designation');
    }

    public function Designations()
    {
        return $this->hasManyThrough('Modules\EmploymentManagement\Entities\Designation', Division::class);
    }

    public function Roles()
    {
        return $this->hasMany('App\Models\Role');
    }

    public function Divisions()
    {
        return $this->hasMany(Division::class);
    }

}
