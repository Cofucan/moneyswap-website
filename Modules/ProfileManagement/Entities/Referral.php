<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    //
    protected $fillable = [
        'profile_id',
        'parent_id',
        'parent_code',
        'lft',
        'rgt',
        'refcount',
        'activated'
    ];
    protected $attributes =
    [
        'activated' => '0',

    ];

    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }
    public function children() {
        return $this->hasOne($this,'parent_id')->with('children');
    }
}
