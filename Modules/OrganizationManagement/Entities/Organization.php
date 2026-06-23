<?php

namespace Modules\OrganizationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\carbon;
class Organization extends  Model
{
    //

    protected $fillable = [
        'legal_name',
        'slug',
        'profile_id',
        'page_id',
        'mission',
        'vision',
        'slogan',
        'official_logo',
        'favicon',
        'date_started',
        'user_id',
        'trading_name',
        'reg_number',
        'vat_number',
        'website_url',
        'status', // Verifified, NotVerified, Reviewing
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
            $model->user_id = Auth::user()->id;
            $model->slug = Str::slug($model->organization_name);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->organization_name);
        });
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(200)
              ->height(200)
              ->sharpen(10);

        $this->addMediaConversion('square')
              ->width(412)
              ->height(412)
              ->sharpen(10);
        $this->addMediaConversion('cover')
              ->width(412)
              ->height(412)
              ->sharpen(10);
    }


    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile')->default(['name' => 'Unclaimed']);
    }

    public function Industry()
    {
        return $this->belongsTo(Industry::class)->withDefault();
    }

    public function Corevalues()
    {
        return $this->hasMany(Corevalue::class);
    }

    public function Guidelines()
    {
        return $this->hasMany('Modules\DocumentManagement\Entities\Guideline');
    }

    public function Page()
    {
        return $this->belongsTo('Modules\ContentManagement\Entities\Page')->withDefault();
    }
    public function Portal()
    {
        return $this->hasOne('App\Models\Portal');
    }
    public function Vacancies()
    {
        return $this->hasMany('Modules\RecruitmentManagement\Entities\Vacancy');
    }


    public function Outlets()
    {
        return $this->hasMany(Outlet::class);
    }
    public function Outlet()
    {
        return $this->hasOne(Outlet::class);
    }
    public function PaymentTerms()
    {
        return $this->hasMany('Modules\PaymentManagement\Entities\PaymentTerm');
    }

    public function BankAccounts()
    {
        return $this->hasMany('Modules\AccountManagement\Entities\BankAccount');
    }

    public function Banks()
    {
        return $this->hasManyThrough('Modules\AccountManagement\Entities\Bank',
        'Modules\AccountManagement\Entities\BankAccount');
    }


    public function getMainAddressAttribute()
    {
        return $this->outlets()->where('outlet_type', 'HeadQuarter')->first()->address;
    }
    public function SocialHandles()
    {
        return $this->hasMany('Modules\SocialManagement\Entities\SocialHandle');
    }
}
