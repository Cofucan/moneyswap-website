<?php

namespace Modules\ProfileManagement\Entities;
use Carbon\carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Auth;

class Profile extends Model
{
    //
    use HasFactory, Hashidable;

    protected $fillable= [
        'role_id',
        'email',
        'organization_id',
        'account_id',
        'outlet_id',
        'country_code',
        'salutation',
        'last_name',
        'first_name',
        'middle_name',
        'birthday',
        'gender',
        'birthplace',
        'activated_at',
        'deactivation_date',
        'status',
        'slug',
        'religion_id',
        'address_id',
        'avatar',
        'referral_code',
        'enabled'
        ];
    protected $attributes =
    [
        'status' => 'Active',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug =Str::slug($model->name);
            $model->enabled =false;
        });
        static::updating(function ($model) {
            $model->slug =Str::slug($model->name);
        });
        self::deleting(function($profile) { // before delete() method call this
            $profile->Telephones()->each(function($telephone){
                $telephone->delete();
            });
            if(!is_null($profile->user))
            {
                $profile->user()->delete();
            }
            if(!is_null($profile->address_id))
            {
                $profile->address()->delete();
            }
            
       });
    }


    public function getNationalityAttribute()
    {
        return $this->Country->citizen_title;
    }
    public function Country()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\Country', 'country_code')->withDefault();
    }
    public function Religion()
    {
        return $this->belongsTo(Religion::class)->withDefault();
    }
    public function getWorshiperAttribute()
    {
        return $this->Religion->worshiper;
    }
    public function getReligiousTitleAttribute()
    {
        return $this->Religion->label;
    }
    public function getDialCodeAttribute()
    {
        return $this->country->dialling_code ?? '234';
    }
    public function getFullNameAttribute()
    {
        return "{$this->salutation} {$this->last_name} {$this->first_name} {$this->middle_name}";
    }
    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
    public function getVirtualNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
    public function getOtherNamesAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['middle_name'];
    }
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getDefaultPasswordAttribute()
    {
        return ucfirst($this->last_name).'_567';
    }
    public function getDegreeAttribute()
    {

        if($this->Educations->count() > 0)
        {
            return $this->educations->last()->degree;
        }
        return 'N/A';
    }

    public function getPassportAttribute()
    {
        if(is_null($this->avatar))
        {
            return 'img/icons/avatar.png';
        }
        return $this->avatar;
    }
    public function getPhonePayable($query, $phone)
    {
        $this->phoneline = '234'.substr($phone,-10);
        $this->fullphone = '0'.substr($phone,-10);
        return $query->with('Telephones','invoiceable')->where('active', true)
                    ->whereHas('Profile.Telephones', function($item){
                        $item->where('phone_number', $this->phoneline)->orWhere('phone_number', $this->fullphone);
                    })->first();
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = Str::upper($value);
    }
    public function setBirthdayAttribute($value)
    {
        if(!is_null($value))
        {
            return $this->attributes['birthday'] = date('Y-m-d', strtotime($value));
        }
        return NULL;
    }
    public function Relatives()
    {
        return $this->hasMany(Relative::class);
    }

    public function Vital()
    {
        return $this->hasOne(Vital::class);
    }
    public function pictures()
    {
        return $this->morphMany('Modules\DocumentManagement\Entities\Picture', 'picturable');
    }
    public function display()
    {
        return $this->morphOne('Modules\DocumentManagement\Entities\Picture', 'picturable')->latestOfMany();
    }
    public function Attachment()
    {
        return $this->morphOne('Modules\MediaManagement\Entities\Attachment', 'attachable')->latestOfMany();
    }
    public function MedicalConditions()
    {
        return $this->hasMany('Modules\HealthManagement\Entities\MedicalCondition');
    }
    public function getAgeAttribute()
    {
        if(is_null($this->birthday))
        {
            return 'N/A';
        }
        return Carbon::parse($this->birthday)->age;
    }
    public function Documents()
    {
        return $this->hasMany('Modules\DocumentManagement\Entities\Document'::class);
    }
    public function Registrations()
    {
        return $this->hasMany('Modules\RegistrationManagement\Entities\Registration');
    }

    public function Parent()
    {
        return $this->belongsTo(Profile::class, 'parent_id');
    }

    public function MedicalContacts()
    {
        return $this->hasMany('Modules\HealthManagement\Entities\MedicalContact');
    }

    public function scopeVendor($query)
    {
        return $query->where('department_id', 5);
    }
    public function scopeManagement($query)
    {
        return $query->with('Organization')->where('profile_type_id', 1);
    }
    public function scopeGuardians($query)
    {
        return $query->with('Organization')->where('role_id', 5);
    }
    public function scopeCandidates($query)
    {
        return $query->where('role_id', 9);
    }
    public function scopeWards($query, $parent= null)
    {
        return $query->where('role_id', 9);
    }

    public function scopeTeacher($query)
    {
        return $query->where('department_id', 3);
    }
    public function scopeAdministrators($query)
    {
        return $query->where('department_id', 6);
        //return $query->where('price', '<', 100);
    }
    public function scopeChildren($query, $profileId = null)
    {
        if(is_null($profileId))
        {
            $profileId = Auth::user()->profile_id;
        }
        $this->profile_id = $profileId;
        return $query->with('Profile')
                        ->whereHas('Profile.Admission', function($item){
                        $item->where('agent_id', $this->profile_id);
                        })->orderBy('created_at', 'Desc');
    }
    public function scopeBillables($query)
    {
        if(Auth::user()->profile->role_id == 5)
        {
            return $query->where('role_id', 9);
            // $profile = Profile::wards()->get();
        }else{
            return $query->where('role_id', 9);
        }
    }

    public function scopeSupports($query)
    {
        return $query->where('department_id', 7);
        //return $query->where('price', '<', 100);
    }

    /* public function parents()
    {
        return $query->where('department_id', 3);
    } */
    public function Clients()
    {
        return $this->hasManyThrough('Modules\ClientManagement\Entities\Client', Agent::class);
    }


    public function Admission()
    {
        return $this->hasOne('Modules\AdmissionManagement\Entities\Admission');
    }

    public function Employee()
    {
        return $this->hasOne('Modules\HumanResources\Entities\Employee');
    }
    public function Resume()
    {
        return $this->hasOne('Modules\HumanResources\Entities\Resume');
    }
    public function Employments()
    {
        return $this->hasMany('Modules\HumanResources\Entities\Employment');
    }
    public function Skillsets()
    {
        return $this->hasMany('Modules\HumanResources\Entities\Skillset');
    }
    public function Educations()
    {
        return $this->hasMany('Modules\HumanResources\Entities\Education');
    }
    public function Education()
    {
        return $this->hasOne('Modules\HumanResources\Entities\Education')->latestOfMany();
    }
    public function Merchant()
    {
        return $this->hasOne('Modules\OrganizationManagement\Entities\Merchant');
    }
    public function Organization()
    {
        return $this->belongsTo('Modules\OrganizationManagement\Entities\Organization')->withDefault(['Organization_name' => 'NIL']);
    }

    public function Address()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\Address')->withDefault();
    }

    public function getContactAddressAttribute()
    {
        if(is_null($this->address_id))
        {
            return 'N/A';
        }
        return $this->Address->full_address;
    }

    public function Client()
    {
        return $this->hasOne('Modules\OrphanManagement\Entities\Client');
    }

    public function OutstandingPayments()
    {
        return $this->Invoices()->where('status', 'Pending')->sum('invoices.amount');
    }

    public function Advices()
    {
        return $this->hasMany('Modules\PaymentManagement\Entities\Advice');
    }

    public function Revenues()
    {
        return $this->hasManyThrough('Modules\PaymentManagement\Entities\Revenue', 'Modules\PaymentManagement\Entities\Advice');
    }
    public function Beneficiaries()
    {
        return $this->hasMany('Modules\ExpenseManagement\Entities\Beneficiary');
    }
    public function Beneficiary()
    {
        return $this->hasOne('Modules\ExpenseManagement\Entities\Beneficiary')->latest();
    }
    public function PaymentsValue()
    {
        return $this->Revenues()->sum('revenues.amount');
    }

    public function Transactions()
    {
        return $this->hasManyThrough('Modules\TransactionManagement\Entities\Transaction', 'App\Models\User');
    }

    public function scopeByPhone($query, $phone)
    {
        $this->phoneline = '234'.substr($phone,-10);
        $this->fullphone = '0'.substr($phone,-10);
        return $query->whereHas('Telephones', function($item){
                    $item->where('phone_number', $this->phoneline)->orWhere('phone_number', $this->fullphone);
                    })->first();

    }

    public function scopeRegistrationForms($profile_id)
    {
        $this->profile_id = $profile_id;
        return $this->hasMany('Modules\RegistrationManagement\Entities\Registration')
                    ->whereHas('Profile', function($item){
                        $item->where('parent_id', $this->profile_id);
                    })->orderBy('created_at', 'Desc');
    }
    public function scopeComingBirthdays($query, $days = null)
    {
        if(is_null($days))
        {
            $days = 30;
        }
        return $query->whereNotNull('birthday')->whereBetween('birthday', [now(), now()->addDays($days)])
        ->orderBy('birthday')->get()
        ->groupBy(function ($val)
        {
            return Carbon::parse($val->birthday)->format('d');
        });
    }

    public function TotalRegistrations()
    {
        return $this->Registrations()->count();
    }

    public function Communications()
    {
        return $this->hasManyThrough('Modules\CommunicationManagement\Entities\Communication',
        'Modules\EnrolmentManagement\Entities\Enrolment');
    }

    public function Telephones()
    {
        return $this->morphMany('Modules\ContactManagement\Entities\Telephone', 'phoneable');
    }

    public function DefaultPhone()
    {
        return $this->morphOne('Modules\ContactManagement\Entities\Telephone', 'phoneable')->where('phone_tag', 'Default');
    }

    public function getTelephoneAttribute()
    {
        return $this->DefaultPhone->phone_number ?? 'None';
    }
    public function getTitleAttribute()
    {
        return $this->role->label;
    }


    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function VirtualAccount()
    {
        return $this->hasOne('Modules\AccountManagement\Entities\VirtualAccount');
    }
    public function Agent()
    {
        return $this->hasOne(Agent::class);
    }


    public function role()
    {
        return $this->belongsTo('Modules\RoleManagement\Entities\Role');
    }

    public function RoleCategory()
    {
        return $this->belongsTo('Modules\RoleManagement\Entities\RoleCategory');
    }

}
