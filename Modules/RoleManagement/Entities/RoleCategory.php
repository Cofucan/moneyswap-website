<?php

namespace Modules\RoleManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class RoleCategory extends Model
{
    //
    protected $fillable = [
        'profile_type',
        'slug',
        'public_name',
        'overview',
        'is_default',
        'published'
    ];
    protected $attributes =
    [
        'published' => '1',
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->profile_type);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->profile_type);
        });
      /*   self::deleting(function ($subjectcategory) {
            $subjectcategory->Subjects()->each(function($subject){
                $subject->delete();
            });
        }); */
    }
    public function Lives()
{
    return $this->morphMany('Modules\MeetingManagement\Entities\Live', 'liveable');
}
    public function Profiles()
    {
        return $this->hasManyThrough('Modules\ProfileManagement\Entities\Profile', Role::class);
    }

    public function Roles()
    {
        return $this->hasMany(Role::class);
    }

    public function Designations()
    {
        return $this->hasManyThrough('Modules\EmploymentManagement\Entities\Designation', Role::class);
    }
}
