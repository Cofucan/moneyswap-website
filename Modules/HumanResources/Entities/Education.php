<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
class Education extends Model
{
    use HasFactory, Hashidable;
    // protected $connection = 'skoojobs';
    protected $fillable = [
        'profile_id',
        'organization_id', // institution of study
        'course_id', // course studied
        'qualification_id', // graduation qualification
        'started_at',
        'completed_at',
        'cgpa', //level
        'published', // to be displayed or not
        'status' // Scheduled, Approved, Public
    ];
    protected $attributes =
    [
        'status' => 'Scheduled',
        'published' => true
    ];

    public function Course()
    {
        return $this->belongsTo('Modules\CurriculumManagement\Entities\Course');
    }
    public function Qualification()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Qualification');
    }

    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }

    public function Organization()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Organization');
    }

    public function scopeScheduled($query)
    {
        return $query->with('Qualification', 'Course', 'Organization', 'Profile')->where('status', 'Scheduled');
    }
    public function scopeActive($query)
    {
        return $query->with('Qualification', 'Course', 'Organization', 'Profile')->where('status', 'Approved')->where('published', true);
    }
    public function scopeAvailable($query)
    {
        return $query->with('Qualification', 'Course', 'Organization', 'Profile');
    }
    public function scopeCandidate($query, $profileId)
    {
        return $query->with('Qualification', 'Course', 'Organization')->where('profile_id', $profileId);
    }
    public function getPeriodAttribute()
    {
        if(is_null($this->completed_at))
        {
            return $this->started_at . '- till date';
        }
        return $this->started_at . ' - '. $this->completed_at;
    }

    public function getMajorAttribute()
    {
        return $this->course->title_name;
    }
    public function getDegreeAttribute()
    {
        if(is_null($this->course_id))
        {
            return $this->Qualification->label;
        }
        return $this->Qualification->acronym . ' ' . $this->major ;
    }
    public function getTitleAttribute()
    {
        return $this->Qualification->acronym ;
    }
}
