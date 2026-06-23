<?php

namespace Modules\ClientManagement\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Application extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'profile_id',
        'admission_schedule_id',
        'batch_id',
        'current_grade_id',
        'agent_id',
        'email',
        'telephone',
        'relationship_id',
        'stream_id',
        'client_category_id',
        'reside_with_profile_id',
        'state_of_origin_id',
        'avatar',
        'submitted_at',
        'registration_stage_id',
        'outlet_id',
        'enabled',
        'status' // Draft, Reviewing, Approved/Rejected, Shortlisted, Offered, Accepted/Declined, Enrolled

    ];
    protected $attributes =
    [
        'status' => 'Draft',
        'enabled' => 0
    ];
    public static function boot() {
        parent::boot();
         static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });
        static::deleting(function($model) { // before delete() method call this
           //  $model->Options()->delete();
             //$model->Profile()->delete();
        });
    }
    public function Invoice()
    {
        return $this->morphOne('Modules\InvoiceManagement\Entities\Invoice', 'invoiceable');
    }
    public function AdmissionSchedule()
    {
        return $this->belongsTo('Modules\AdmissionManagement\Entities\AdmissionSchedule');
    }
    public function AdmissionGrade()
    {
        return $this->belongsTo('Modules\AdmissionManagement\Entities\AdmissionGrade');
    }

    public function ClientCategory()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\ClientCategory');
    }

    public function Stream(){
        return $this->belongsTo('Modules\SchoolManagement\Entities\Stream');
    }

    public function CurrentGrade()
    {
        return $this->belongsTo('Modules\SchoolManagement\Entities\Level', 'current_grade_id');
    }

    public function Outlet()
    {
    return $this->belongsTo('Modules\SchoolManagement\Entities\Outlet');
    }

    public function Profile ()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }

    public function Admission()
    {
    return $this->hasOne('Modules\AdmissionManagement\Entities\Admission');
    }
    public function AdmissionOffer()
    {
    return $this->hasOne(AdmissionOffer::class);
    }

    public function getSponsorAttribute()
    {
        return $this->Profile->Parent->name;
    }



public function RegistrationDocuments()
{
    return $this->hasMany(RegistrationDocument::class);
}

public function DocumentTypes()
{
    return $this->hasManyThrough(DocumentType::class, RegistrationDocument::class);
}


public function scopeBystatus($query, $status)
{
    return $query
            ->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
            ->where('status', $status)
            ->orderBy('created_at', 'DESC');
}

public function scopeActive($query)
{
    return $query->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
                ->where('active', true)
                ->orderBy('created_at', 'DESC');
}
public function scopeSubmissions($query)
{
    return $query->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
                ->where('status', 'Scheduled')
                ->orderBy('created_at', 'DESC');
}
public function scopeAvailable($query)
{
    return $query->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
                ->orderBy('created_at', 'DESC');
}
public function scopeOwn($query)
{
    return $query->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'DESC');
}
public function scopeByFamily($query, $profileId)
{
    $this->profile_id = $profileId;
    return $query->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
    ->whereHas('Profile', function($q){
        $q->where('parent_id', $this->profile_id);
    })->orderBy('created_at', 'DESC');
}
public function scopeByTerm($query, $academictermId)
{
    $this->academic_term_id = $academictermId;
    return $query->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
    ->whereHas('AdmissionSchedule', function($q){
        $q->where('academic_term_id', $this->academic_term_id);
    })->orderBy('created_at', 'DESC');
}

public function scopeByGrade($query, $grade_id)
{
    $this->grade_id = $grade_id;
    return $query->with('Profile', 'Profile.Person','CurrentGrade', 'AdmissionGrade', 'ClientCategory', 'AdmissionSchedule', 'Outlet')
    ->whereHas('AdmissionGrade', function($q){
        $q->where('grade_id', $this->grade_id);
    })->orderBy('created_at', 'DESC');
}
/* public function scopeTotal($query, $status){
    return $query->where('status', $status);
} */

}
