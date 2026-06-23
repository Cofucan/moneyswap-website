<?php

namespace Modules\CommunicationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;
use Auth;

class Objection extends Model
{
    //
    protected $fillable = [
        'reference_code',
        'creator_id',
        'objectionable_type',
        'objectionable_id',
        'reason',
        'resolved_at',
        'resolved'  
    ];  
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->creator_id = Auth::user()->id;
            $model->resolved = false;
            $model->reference_code = time(). (Objection::where('objectionable_type',$model->objectionable_type)->count()+1);

        });
       
    }
 
    public function objectionable()
    {
    return $this->morphTo();
    }
    
    public function scopePending($query)
    {
        return $query->with('Creator', 'objectionable')->where('resolved', false);
    }
    public function scopeResolved($query)
    {
        return $query->with('Creator', 'objectionable')->where('resolved', true);
    } 

    public function Creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }
}
