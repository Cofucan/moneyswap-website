<?php

namespace  Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
class Member extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'profile_id',
        'designation_id',
        // 'income',
        // 'currency',
        // 'clients',
        'is_active'
    ];

    protected $attributes =
    [
        'is_active' => true,
    ];
    public function getNameAttribute()
    {
        return $this->profile->last_name;
    }
    public function getFullNameAttribute()
    {
        return $this->profile->full_name;
    }
    public function getStatusAtttribute()
    {
        if($this->is_active == true)
        {
            return 'Active';
        }
        return 'Not Active';
                           
    }
    public function Profile()
    {
        return $this->belongsTo(Profile::class);
    }

   
    public function scopeActive($query)
    {
        $query->with('Profile')->where('is_active', true);
    }
}
