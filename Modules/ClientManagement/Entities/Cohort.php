<?php

namespace Modules\ClientManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Carbon\Carbon;
use Auth;

class Cohort extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'batch_id',
        'outlet_id', //remove
        'academic_term_id',
        'enrolment_type',
        'user_id',
        'overview',
        'scheduled_at',
        'approver_id',
        'status',
        'enabled'
    ];
    protected $attributes = [
        'enabled' => false,
        'status' => 'Draft'
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });
    }

    public function getLabelAttribute()
    {
        return $this->Batch->label;
    }
    public function getClassAttribute()
    {
        return $this->Batch->Level->label;
    }

    public function getSchoolTermAttribute()
    {
        return $this->AcademicTerm->label;
    }
    public function getStudentsCampusAttribute()
    {
        return $this->Outlet->label;
    }

    public function getCreatorAttribute()
    {
       return $this->User->Profile->full_name;
    }

    public function getDateCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    public function getDateScheduledAttribute()
    {
        return Carbon::parse($this->scheduled_at)->toFormattedDateString();
    }
    public function getLastUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->toFormattedDateString();
    }

    public function getApprovedByAttribute()
    {
       return $this->Approver()->Profile->full_name;
    }

    public function Batch()
    {
        return $this->belongsTo('Modules\SchoolManagement\Entities\Batch');
    }

    public function Outlet()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Outlet');
    }

    public function Clients()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client');
    }

    public function AcademicTerm()
    {
        return $this->belongsTo('Modules\CalendarManagement\Entities\AcademicTerm');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function Approver()
    {
        return $this->belongsTo('App\Models\User', 'approver_user_id');
    }
    public function scopeAvailable($query)
    {
        return $query->with('Outlet', 'Batch');
    }
    public function scopeTerm($query, $academictermId)
    {
        return $query->with('Outlet', 'Batch')->where('academic_term_id', $academictermId);
    }
}
