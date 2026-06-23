<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class VolunteerCategory extends Model
{
    //
    protected $fillable = [
        'label',
        'overview',
        'benefits',
        'enabled'

    ];

    protected $attributes = [
        'enabled' => '1',
    ];

    public static function boot()
    {
        parent::boot();       
        self::deleting(function ($model) {            
            $model->Dues()->each(function($due){
                $due->delete();
            });         
        });
    }
     

    public function Volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function scopeActive($query)
    {
        return $query->whereEnabled(true)->get();
    }


}
