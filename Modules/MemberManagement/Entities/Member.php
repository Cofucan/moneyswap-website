<?php

namespace Modules\MemberManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;

class Member extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'agent_id',
        'registration_id',
        'relationship_id',
        'grade_id',
        'profile_id',
        'entry_number',
        'academic_term_id',
        'client_category_id',
        'reside_with_family',
        'campus_id',
        'stream_id',
        'status', //recommended, offered, accepted, declined, Approved, withdrawn, enrolled
        'offerred_at',
        'approved_at',
        'approver_user_id',
        'feedback_at',
        'feedback_deadline',
        'creator_user_id',
        'availability',
        'remarks'
    ];


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->creator_user_id = Auth::user()->id;
            $model->availability = true;
        });
        /* static::updating(function ($model) {
            $model->slug = Str::slug($model->headline);
        }); */
    }
    public function getReferenceCodeAttribute()
    {
        return "SVIC-".Str::PAD_LEFT($this->entry_number,4,'0');
    }
    public function getGradeLevelAttribute()
    {
        return $this->Level->label. ' ( '. $this->Stream->label . ' )' ;
    }
    public function getCandidateNameAttribute()
    {
        return $this->Profile->candidate_name ;
    }
    public function getEffectiveTermAttribute()
    {
        return $this->AcademicTerm->label ;
    }
    public function getMemberYearAttribute()
    {
        return $this->AcademicTerm->AcademicSession->school_year ;
    }
    public function getMemberNumberAttribute()
    {
        return $this->Client->member_code ;
    }
    public function getOfferDateAttribute()
    {
        if(is_null($this->offered_at))
        {
            return 'N/A';
        }
        return Carbon::parse($this->offered_at)->toDayDateTimeString();
    }

    public function getFeedbackDateAttribute()
    {
        if(is_null($this->feedback_at))
        {
            return 'N/A';
        }
        return Carbon::parse($this->feedback_at)->toDayDateTimeString();
    }

    public function getDeadlineAttribute($value)
    {
        if(is_null($this->feedback_deadline))
        {
            return 'N/A';
        }
        return Carbon::parse($this->feedback_deadline)->format('l jS \\of F Y ');
            //return Carbon::parse($value)->toDayDateTimeString();
    }
    public function getDateSubmittedAttribute($value)
    {

        return Carbon::parse($this->created_at)->format('l jS \\of F Y ');
            //return Carbon::parse($value)->toDayDateTimeString();
    }
    public function Registration()
    {
        return $this->belongsTo('Modules\RegistrationManagement\Entities\Registration')->withDefault();
    }

    public function Enrolments()
    {
        return $this->hasMany('Modules\EnrolmentManagement\Entities\Enrolment');
    }

    public function CurrentEnrolment()
    {
        return $this->hasOne('Modules\EnrolmentManagement\Entities\Enrolment')->where('enrolments.published', true);
    }
    public function Enrolment()
    {
        return $this->hasOne('Modules\EnrolmentManagement\Entities\Enrolment')->where('enrolments.published', true);
    }

    public function Communications()
    {
        return $this->hasManyThrough('Modules\CommunicationManagement\Entities\Communication',
        'Modules\EnrolmentManagement\Entities\Enrolment');
    }

    public function Client()
    {
        return $this->hasOne('Modules\ClientManagement\Entities\Client');
    }

    public function CurrentClass()
    {
        return $this->hasOne('Modules\ClientManagement\Entities\Client')->latest();
    }

    public function Level()
    {
        return $this->belongsTo('Modules\SchoolManagement\Entities\Level');
    }

    public function Stream()
    {
        return $this->belongsTo('Modules\SchoolManagement\Entities\Stream');
    }

    public function AcademicTerm()
    {
        return $this->belongsTo('Modules\CalendarManagement\Entities\AcademicTerm');
    }

    public function ClientCategory()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\ClientCategory');
    }

    public function Campus()
    {
        return $this->belongsTo('Modules\SchoolManagement\Entities\Campus')->withDefault();
    }
    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }
    public function Agent()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Agent');
    }

    public function scopeInfo($query, $offerno)
    {
        return $query->with('Registration', 'Level', 'AcademicTerm', 'Profile', 'Level', 'Stream')->where('entry_number', $offerno)->first();
    }

    public function scopeByStatus($query, $status)
    {
        return $query->with('Registration', 'Level', 'AcademicTerm', 'Profile', 'Level', 'Stream')->where('status', $status)->orderBy('updated_at', 'Desc');
    }
    public function scopeChildrenMembers($query, $customerId)
    {
        return $query->with('Registration', 'Level', 'AcademicTerm', 'Profile', 'Level', 'Stream')->where('profile_id', $customerId);
    }
    public function scopeActive($query)
    {
        return $query->with('Registration', 'Level', 'AcademicTerm', 'Profile', 'Level', 'Stream')->where('status', 'Approved');
    }

}
