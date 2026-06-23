<?php

namespace Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
    //
    protected $fillable = [
        'profile_id',
        'blood_group',
        'genotype',
        'height',
        'weight',
        'complexion',
        'tribal_marks',
        'eye_colour',
        'hair_colour',
        'published'
    ];

    protected $attribute = [
        'published' => 1
    ];

    public function Profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
