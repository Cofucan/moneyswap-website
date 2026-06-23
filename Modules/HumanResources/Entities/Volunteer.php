<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth; 
use Carbon\carbon;

class Volunteer extends Model
{
   
   use Notifiable, HasFactory, Hashidable;
protected $fillable = [

'reference',
'referral_code',
'volunteer_category_id',
'expertise_id',
'profile_id',
'activated_at',
'expire_at',
'status', //Active, InActive, Dormant,
'createdby_user_id'
];


public function routeNotificationForMail()
{
    return $this->profile->email;
}

public static function boot()
    {
        parent::boot();
       /*  static::creating(function ($model) {
            //$model->available_balance = $model->ledger_balance;
        });
         static::updating(function ($model) {
            //$model->user_id = Auth::id();
        }); */
        self::deleting(function ($model) {    
            //
            $model->Person->delete();    
            if($model->Orders->count() > 0)    
            {
                $model->Orders()->each(function($item){
                    $item->delete();
                }); 
            }
        }); 
}




public function VolunteerCategory()
{
    return $this->belongsTo(VolunteerCategory::class);
}

public function Profile()
{
    return $this->belongsTo(Profile::class);
}
public function Creator()
{
    return $this->belongsTo(User::class, 'createdby_user_id');
}


}
