<?php

namespace Modules\CatalogManagement\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Level extends Model
{
    //
protected $fillable = [
'label',
'slug',
'program_id', //replace with school_id
'parent_id',
'overview',
'is_terminal',
'enabled'
];
protected $attributes = [
    'enabled' => true,
    'parent_id' => '0'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->label);
            $model->is_terminal = false;
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->label);
        });
      /*   self::deleting(function ($subjectcategory) {
            $subjectcategory->Subjects()->each(function($subject){
                $subject->delete();
            });
        }); */
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getPreviousAttribute()
    {
        if(is_null($this->parent_id))
        {
            return 'N/A';
        }
        return $this->Parent->label;
    }
    public function Parent()
    {
        return $this->belongsTo(Level::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Level::class, 'parent_id');
    }
    public function Child()
    {
        return $this->hasOne(Level::class, 'parent_id');
    }
    public function Program()
    {
    return $this->belongsTo(Program::class);
    }


    public function Registrations()
    {
        return $this->hasMany('Modules\RegistrationManagement\Entities\Registration');
    }



    public function Batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function Attendances()
    {
        return $this->hasMany(Attendance::class);
    }


    public function AdmissionDocuments()
    {
        return $this->hasMany(AdmissionDocument::class);
    }

    public function Students()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client');
    }

    public function ActiveStudents()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client')->whereEnabled(true);
    }

    public function InactiveStudents()
    {
        return $this->hasMany('Modules\ClientManagement\Entities\Client')->whereEnabled(false);
    }

    public function Enrolments()
    {
        return $this->hasManyThrough('Modules\EnrolmentManagement\Entities\Enrolment',
        Batch::class)->where('enrolments.enabled', true);
    }


    public function Clubs()
    {
        return $this->hasManyThrough(Club::class, Program::class)->where('clubs.published', true);
    }

    public function scopeByTag($query, $tag)
    {
        return $query->with('Program')->where('slug', $tag)->first();
    }

    public function scopeByProgram($query, $programId)
    {
        return $query->active()->where('program_id', $programId);
    }
    public function scopeActive($query)
    {
        return $query->with('Program')->where('enabled', true);
    }

    public function scopeGraduating($query)
    {
        return $query->with('Program')->where('is_terminal', true);
    }

    public function scopeTermSubjects($query, $termId)
    {
        return $query->with('Program')->where('enabled', true);
    }

    public function Fees()
    {
        return $this->morphMany('Modules\FeeManagement\Entities\Fee', 'feeable');
    }

}
