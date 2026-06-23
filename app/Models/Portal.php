<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use Modules\ClientManagement\Entities\Organization;

class Portal extends Model
{
    //
    // use HasFactory, Hashidable;
    protected $fillable = [
        'email',
        'telephone',
        'subdomain',
        'portal_name',
        'default_currency',
        'custom_url',
        'date_started',
        'portal_status',
        'date_published',
        'user_id',
        'visits',
        'page_id'
    ];
    //const CREATED_AT = 'enquiry_date';
    protected $attributes =
    [
        'portal_status' => '0',
        'default_currency' => 'NGN',
        'visits' => '0'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->user_id = Auth::user()->id;
        });
        static::updating(function ($model) {
           // $model->slug = str_slug($model->headline);
        });
    }

    public function getDateStartedAttribute($value)
    {
        return Carbon::parse($value)->format('Y ');
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function Organization()
    {
        return $this->belongsTo('Modules\OrganizationManagement\Entities\Organization');
    }

    public function getAddressAttribute()
    {
        return $this->organization->mainaddress;
    }

    public function BankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function getLogoAttribute()
    {
        return $this->Organization->official_logo;
    }

    public function getCompanyNameAttribute()
    {
        return $this->Organization->legal_name;
    }

    public function getFaviconAttribute()
    {
        return $this->Organization->favicon;
    }

    public function getSloganAttribute()
    {
        return $this->Organization->slogan;
    }

}
