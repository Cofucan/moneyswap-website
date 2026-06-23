<?php

namespace  Modules\ProfileManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Auth;
class Agent extends Model
{
    use HasFactory, Hashidable;
    protected $fillable = [
        'profile_id',
        'occupation_id',
        'annual_income',
        'currency_code',
        'total_clients',
        'status',
        'enabled'
    ];

    protected $attributes =
    [
        'enabled' => true,
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });
        self::deleting(function($model) { // before delete() method call this
            $model->profile->delete();
            if(!is_null($model->clients))
            {
                $model->Clients()->each(function($client){
                    $client->delete();
                });
            }
       });
    }
    public function getTelephoneAttribute()
    {
        return $this->profile->telephone;
    }
    public function getTotalClientsAttribute()
    {
        $counter = $this->clients()->count();
        return  !empty($counter) ? $counter :0;
    }
    public function getIncomeAttribute()
    {
        if(is_null($this->annual_income))
        {
            return 'N/A';
        }
        return $this->currency_code . ' ' . number_format($this->annual_income,2);
    }
    public function getEmailAttribute()
    {
        return $this->profile->email;
    }
    public function getNameAttribute()
    {
        return $this->profile->last_name;
    }
    public function getFullNameAttribute()
    {
        return $this->profile->full_name;
    }
    public function getRepresentativeAttribute()
    {
        return $this->profile->full_name;
    }
    public function getActivityStatusAttribute()
    {
        if($this->enabled == true)
        {
            return 'Active';
        }
        return 'Inactive';
    }

    public function Profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function Occupation()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Occupation');
    }

    public function Clients()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client');
    }
    public function uncompletedclients()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client')->where('status', 'Draft');
    }

    public function Advices()
    {
        return $this->hasMany('Modules\PaymentManagement\Entities\Advice');
    }

 /*    public function scopePayments()
    {
        return $query->with('Profile',  'Clients.Revenue')
                    ->whereHas('Clients.Revenue.Invoice.Client', function($item){
                    $item->where('agent_id', $this->profile_id);
                    })->orderBy('created_at', 'Desc');
    } */
    public function scopeByTelephone($query, $telephone)
    {
        $this->phone = '234'.substr($telephone,-10);
        $this->fullphone = '0'.substr($telephone,-10);
        //dd($this->phone);
        return $query::with('Profile')->whereHas('Profile.Telephones', function($item){
            $item->where('phone_number', $this->phone)->orWhere('phone_number', $this->fullphone);
        })->first();

    }




    public function PendingInvoices()
    {
        return $this->hasManyThrough('Modules\InvoiceManagement\Entities\Invoice',
        'Modules\ClientManagement\Entities\Client')->whereActive(true);
    }


    public function ScopeInvoice($query, $profile_id)
    {
        $this->profile_id = $profile_id;
        return $query->with('Profile',  'Profile.Client','invoiceable')->where('active', true)
                    ->whereHas('Profile.Client', function($item){
                    $item->where('agent_id', $this->profile_id);
                    })->orderBy('created_at', 'Desc');

    }
    public function scopeByProfileId($query, $profileId)
    {
        return $query->with('Profile', 'Profile.Telephones', 'Clients')->where('profile_id', $profileId)->firstOrFail();
    }
    public function scopeActive($query)
    {
        return $query->with('Profile', 'Profile.Telephones', 'Clients', 'Invoices')->where('enabled', true);
    }
    public function scopeAvailable($query)
    {
        return $query->with('Profile', 'Profile.Telephones', 'Clients', 'Invoices')->get();
    }
}
