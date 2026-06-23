<?php

namespace Modules\ClientManagement\Entities;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;

class Client extends Model
{
    use HasFactory, Hashidable;
    protected $fillable = [
    'reference',
    'cohort_id',
    'profile_id',
    'position_in_family',
    'agent_id',
    'relationship_id',
    'client_category_id',
    'program_id',
    'outlet_id',
    'required_tenure',
    'enrolled_at',
    'deactivated_at',
    'user_id',
    'status', //Schedule, Active, Disqualified, Withdrawn
    'enabled'
    ];

public static function boot() {
    parent::boot();
        static::creating(function ($model) {
        $model->user_id = Auth::user()->id;

    });
    static::deleting(function($model) { // before delete() method call this
        $model->Kindreds()->each(function($kindred){
            $kindred->delete();
        });
        $model->Applications()->each(function($application){
            $application->delete();
        });
        $model->Profile()->delete();
    });
}
public function getMerchantCodeAttribute()
{
    if(is_null($this->outlet_id))
    {
        return 100124;
    }
    return $this->Outlet->Portal->reference;
}

public function getLabelAttribute()
{
    if(is_null($this->reference))
    {
        return $this->Profile->name;
    }
    return $this->Profile->name . ' - '. $this->reference;
}
public function getNameAttribute()
{
    return $this->Profile->name;
}
public function getCategoryNameAttribute()
{
    return $this->ClientCategory->label;
}
public function getProgramNameAttribute()
{
    return $this->program->label;
}

public function getGenderAttribute()
{
    return $this->profile->gender;
}

public function getAgeAttribute()
{
    return $this->profile->age;
}
public function getNationalityAttribute()
{
    return $this->profile->Country->citizen_title;
}

public function getTelephoneAttribute()
{
    return $this->profile->telephone;
}

public function getEmailAttribute()
{
    return $this->profile->email ?? STR::slug($this->label).'@amofaks.org';
}

public function getAgentNameAttribute()
{
    return $this->Agent->representative;
}

public function getRelationshipTypeAttribute()
{
    if(is_null($this->relationship_id))
    {
        return 'N/A';
    }
    return $this->Relationship->label;
}

public function getPaymentMethodAttribute()
{
    return $this->TransactionMethod->label ?? 'None';
}
public function getBankNameAttribute()
{
    return $this->VirtualAccount->bank_name ?? 'None';
}
public function getAccountNumberAttribute()
{
    return $this->VirtualAccount->account_number ?? 'None';
}
public function getAccountNameAttribute()
{
    return $this->VirtualAccount->account_name ?? 'None';
}

public function getAmountOwedAttribute()
{
    return number_format($this->PayableInvoices->sum('outstanding'));
}
public function getArchivedDebtAttribute()
{
    if(empty($this->InvoiceArchives))
    {
        return 0.00;
    }
    return number_format($this->InvoiceArchives->sum('amount'));
}

public function getWalletBalanceAttribute()
{
    return  number_format($this->Wallet->balance);
}

public function getWalletAmountAttribute()
{
    return $this->Wallet->balance;
}

public function getTotalPaymentsAttribute()
{
    return number_format($this->Revenue->sum('amount'));
}

public function getSupportGroupAttribute()
{
    return $this->Program->Cause->label;
}

public function getStatusLabelAttribute()
{

    switch ($this->status){
        case "Scheduled":
        $label = 'Enrolments Pending Approval';
        break;
        case "Approved":
            $label = 'Active Enrolments Without Revenue(s)';
        break;
        case "Partial-Revenue":
            $label = 'Enrolments With Partial Revenue(s)';
        break;
        case "Paid":
            $label = ' Client(s) Have Full Enrolment Revenue';
        break;
        case "No-show":
            $label = 'Client(s) Didnt Show-Up At Resumptions';
        break;
        case "Discountinued":
            $label = 'Client(s) Didnt Finish The Term';
        break;
    }
    return $label;
}

public function ScopeByAgentProfile($query, $profileId)
{
    $this->profileId = $profileId;
    return $query->with('Profile', 'Program')
            ->whereHas('Agent', function($query) {
                $query->where('profile_id', $this->profileId);
            });
}
public function ScopeByAgent($query, $agentId)
{
    return $query->with('Program','Program.Cause', 'ClientCategory', 'Outlet', 'Profile')
                ->where('agent_id', $agentId)
                ->orderBy('created_at', 'Desc');
}
public function ScopeMine($query)
{
    return $query->with('Program','Program.Cause', 'ClientCategory', 'Outlet', 'Profile')
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'Desc');
}
public function scopebyBatch($query, $batchId)
{
    return $query->active()->where('batch_id', $batchId);
}
public function scopeByGrade($query, $gradeId)
{
    $this->gradeId = $gradeId;
    return $query->active()
            ->whereHas('Program', function($query) {
                $query->where('grade_id', $this->gradeId);
            });
}
public function scopeScholarships($query)
{
    return $query->where('enabled', true)->has('Application');
}
public function scopeNoApplication($query)
{
    return $query->active()->doesnthave('Application');
}
public function ScopeByCause($query, $causeId)
{
    $this->cause_id = $causeId;
    return $query->with('Program','Program.Cause', 'Profile', 'ClientCategory', 'Outlet')
                ->whereHas('Cause', function($query) {
                    $query->where('cause_id', $this->program_id);
                })->orderBy('reference', 'Desc');
}
public function scopeByStatus($query, $status)
{
    return $query->with('Program','Program.Cause', 'Profile', 'ClientCategory', 'Outlet')->where('status', $status);
}
public function scopeBuild($query, $gradeId, $status)
{
    return $query->with('Program','Program.Cause', 'Profile', 'ClientCategory', 'Outlet')->where('grade_id', $gradeId)->where('status', $status);
}
public function scopeActive($query, $programId = null)
{
    $query = $query->with('Profile', 'ClientCategory', 'Outlet', 'Program','Program.Cause');
    if(isset($programId))
    {
            $query->where('program_id', $programId);
    }
    return $query->where('clients.enabled', true);
}
public function scopeInActive($query, $gradeId = null)
{
    $query = $query->with('Program','Program.Level', 'Profile', 'ClientCategory', 'Outlet');
    if(isset($gradeId))
    {
        $query->whereGradeId($gradeId);
    }
    return $query->where('clients.enabled', false);
}
public function scopeInClass($query, $batchId = null)
{
    $query = $query->with('Program','Program.Level', 'Profile', 'ClientCategory', 'Outlet');
    if(isset($gradeId))
    {
        $query->whereBatchId($batchId);
    }
    return $query->where('clients.enabled', false);
}

public function scopeAvailable($query)
{
    return $query->with('Program','Program.Cause', 'Profile', 'ClientCategory', 'Outlet')->orderBy('updated_at', 'DESC');
}
public function Coupon()
{
    return $this->morphOne('Modules\InvoiceManagement\Entities\Coupon', 'discountable');
}

public function Revenue()
{
    return $this->hasManyThrough('Modules\PaymentManagement\Entities\Revenue', 'Modules\InvoiceManagement\Entities\Invoice');
}
public function Invoice()
{
    return $this->hasOne('Modules\InvoiceManagement\Entities\Invoice')->where('invoices.enabled', true);
}
public function Invoices()
{
    return $this->hasMany('Modules\InvoiceManagement\Entities\Invoice');
}
public function Orders()
{
    return $this->hasMany('Modules\InvoiceManagement\Entities\Order');
}
public function InvoiceArchives()
{
    return $this->hasManyThrough('Modules\InvoiceManagement\Entities\InvoiceArchive', 'Modules\InvoiceManagement\Entities\Invoice');
}
public function PayableInvoices()
{
    return $this->hasMany('Modules\InvoiceManagement\Entities\Invoice')->where('invoices.enabled', true);
}

public function Account()
{
    return $this->belongsTo('Modules\AccountManagement\Entities\Account')->withDefault('N/A');
}

public function Program()
{
 return $this->belongsTo('Modules\CatalogManagement\Entities\Program');
}
public function Profile()
{
 return $this->belongsTo('Modules\ProfileManagement\Entities\Profile')->withDefault('Offline');
}
public function Agent()
{
 return $this->belongsTo('Modules\ProfileManagement\Entities\Agent')->withDefault();
}
public function Relationship()
{
 return $this->belongsTo('Modules\ProfileManagement\Entities\Relationship')->withDefault('Offline');
}
public function Scholarship()
{
    return $this->morphOne('Modules\InvoiceManagement\Entities\Coupon', 'discountable')->where('coupons.enabled', true);
}

public function Enrolments()
{
return $this->hasMany('Modules\EnrolmentManagement\Entities\Enrolment');
}

public function Enrolment()
{
return $this->hasOne('Modules\EnrolmentManagement\Entities\Enrolment')->latestOfMany();
}


public function ClientCategory()
{
    return $this->belongsTo('Modules\ClientManagement\Entities\ClientCategory');
}



public function SubscriptionHistory()
{
    return $this->hasMany('Modules\SubscriptionManagement\Entities\Subscription');
}
public function Subscriptions()
{
    return $this->hasMany('Modules\SubscriptionManagement\Entities\Subscription')->whereEnabled(true);
}
public function BillableSubscriptions()
{
    return $this->hasMany('Modules\SubscriptionManagement\Entities\Subscription')->whereEnabled(true);
}
public function Kindreds()
{
    return $this->hasMany(Kindred::class);
}


public function last()
{
    return $this->morphOne(Subscription::class, 'subscribable')->latestOfMany();
}

public function Outlet()
{
    return $this->belongsTo('Modules\OrganizationManagement\Entities\Outlet');
}
public function Wallet()
{
    return $this->hasOne('Modules\AccountManagement\Entities\Wallet');
}
public function VirtualAccount()
{
    return $this->hasOneThrough('Modules\AccountManagement\Entities\VirtualAccount', 'Modules\AccountManagement\Entities\Wallet');
}

public function Cohort()
{
    return $this->belongsTo(Cohort::class)->withDefault(['Cohort' => 'None']);
}
public function TransactionMethod()
{
    return $this->belongsTo('Modules\TransactionManagement\Entities\TransactionMethod')->withDefault(['Revenue Method' => 'None']);
}
public function Incidents()
{
    return $this->morphMany('Modules\CommunicationManagement\Entities\Incident', 'incidentable');
}
public function Interventions()
{
    return $this->morphMany('Modules\InterventionManagement\Entities\InterventionPlan', 'interventionable');
}

}
