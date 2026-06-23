<?php

namespace Modules\ClientManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Auth;

class Kindred extends Model
{
    use HasFactory, Hashidable;
    protected $fillable = [
        'profile_id',
        'client_id',
        'relationship_id',
        'expired_at',
        'deceased_cause',
        'status',
        'is_verified',
        'verifiedby_user_id'
    ];

    public static function boot() {
        parent::boot();
            static::creating(function ($model) {
            $model->user_id = Auth::user()->id;

        });
        static::deleting(function($model) { // before delete() method call this
            //  $model->Options()->delete();
                $model->Profile()->delete();
        });
    }
    public function Relationship()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Relationship');
    }
    public function Client()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Client');
    }
    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }
    public function getNameAttribute()
    {
        return $this->profile->name;
    }
    
    public function getConfirmationAttribute()
    {
        if($this->is_verified == true)
        {
            return $this->status . " {Confirmed}";
        }
        return $this->status . " {UnConfirmed}";
    }
    public function ScopeVerified($query)
    {
        return $query->with('Profile', 'Client', 'Relationship')->where('is_verified', true);
    }
    public function ScopeDead($query)
    {
        return $query->with('Profile', 'Client', 'Relationship')->where('status', 'Dead');
    }
}
