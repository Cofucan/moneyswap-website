<?php

namespace Modules\SchoolManagement\Entities;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Auth;

class Batch extends Model
{
    // use HasFactory, Hashidable;
    protected $fillable = [
        'grade_id',
        'stream_id',
        'room_id',
        'label',
        'mandatory_subjects',
        'electrive_subjects',
        'overview',
        'enabled'
        ];
        public static function boot()
        {
            parent::boot();
            static::creating(function ($model) {
                $model->label = $model->Level->label . ' ' . $model->Stream->label ;
                $model->slug = Str::slug($model->label);
            });
        }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getTotalStudentsAttribute()
    {
        return $this->clients->count();
    }
    public function getAcademicGroupsAttribute()
    {
        return $this->stream->label;
    }

    public function Level()
    {
    return $this->belongsTo(Level::class);
    }

    public function Stream()
    {
    return $this->belongsTo(Stream::class);
    }
    public function Room()
    {
    return $this->belongsTo('Modules\LocationManagement\Entities\Room')->withDefault();
    }

    public function scopeActive($query, $programId =null)
    {

        if(!is_null($programId))
        {
            $this->programId = $programId;
            return $query->with('Students')->where('enabled', true)->whereHas('level', function($q){
                $q->where('program_id', $this->programId);
            })->get();
        }
        return $query->with('Level','Stream')->where('enabled', true);
    }
    public function scopeByGrade($query, $gradeId)
    {

        return $query->with('Level', 'Stream')->where('grade_id',$gradeId)->where('enabled', true);
    }

    public function scopeEligible($query, $batch)
    {
        $this->programId = $batch->level->program_id;
        return $query->where('enabled', true)
                        ->whereHas('level', function($q){
                            $q->where('program_id', $this->programId);
                        })->get();
    }
    public function scopeTeacher($query, $employeeId =null)
    {

        if(is_null($employeeId))
        {
            $employeeId = Auth::user()->profile->employee->id;
        }
        $this->employeeId = $employeeId;
        return $query->active()->whereHas('Officials', function($q){
            $q->where('employee_id', $this->employeeId);
        })->get();
    }
    public function Enrolments()
    {
        return $this->hasMany('Modules\EnrolmentManagement\Entities\Enrolment')->where('enrolments.enabled',true);
    }
    public function Students()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client')->whereEnabled(true);
    }
    public function Fees()
    {
        return $this->morphMany('Modules\FeeManagement\Entities\Fee', 'feeable');
    }

    public function Officials()
    {
        return $this->hasMany(Official::class);
    }

    public function EnrolmentHistory()
    {
        return $this->hasMany('Modules\EnrolmentManagement\Entities\Enrolment');
    }

    public function BatchSubjects()
    {
        return $this->hasMany('Modules\CurriculumManagement\Entities\BatchSubject');
    }

}
