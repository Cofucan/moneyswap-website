<?php

namespace Modules\HumanResources\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'designation_id',
        'employment_type_id',
        'department_id',
        'salary_to',
        'salary_from',
        'payment_cycle',
        'currency',
        'display_salary',
        'academic_term_id',
        'description',
        'application_method',
        'application_threshold',
        'close_at',
        'user_id',
        'approved_by',
        'vacancy_ref',
        'vacancy_title',
        'email',
        'years_of_experience',
        'expected_start_date',
        'employees_needed',
        'available_slots',
        'responsibilities',
        'visits',
        'other_requirements',
        'status',
        'campus_id',
        // 'overview',
        'qualification_id'
    ];
    protected $attributes =
    [
        'visits' => '0',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->slug = Str::slug($model->vacancy_title);
            $model->available_slots = $model->employees_needed;
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->vacancy_title);
        });
    }

    public function getCloseAttribute()
    {
        return Carbon::parse($this->close_at)->toFormattedDateString();
    }
    public function EmploymentType()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\EmploymentType');
    }

    public function Neighbourhood()
    {
        return $this->belongsTo('Modules\LocationManagement\Entities\Neighbourhood');
    }

    public function Organization()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Organization');
    }

    public function Qualification()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Qualification');
    }
    public function AcademicTerm()
    {
        return $this->belongsTo('Modules\CalendarManagement\Entities\AcademicTerm');
    }

    public function Designation()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Designation');
    }

    public function Department()
    {
        return $this->belongsTo('Modules\ClientManagement\Entities\Department');
    }

    public function getSalaryAttribute()
    {
        if($this->display_salary == false)
        {
            return 'Confidential';
        }
        if($this->salary_to > 0)
        {
            return 'Upto '. $this->currency.' ' . number_format($this->salary_to,2) . '/'. $this->payment_cycle;
        }
        return $this->currency.' ' . number_format($this->salary_from,2) . '/'. $this->payment_cycle;
    }
    public function getActionDateAttribute()
    {
        if($this->expire_at == Carbon::today())
        {
            return 'Expiring Today';
        }
        return Carbon::parse($this->expire_at)->diffForHumans();
    }
    public function getAvailableDateAttribute()
    {
        if($this->approved_at == Carbon::today())
        {
            return 'Posted Today';
        }
        return Carbon::parse($this->approved_at)->diffForHumans();
    }

    public function Objections()
    {
        return $this->morphMany('Modules\CommunicationManagement\Entities\Objection', 'objectionable');
    }
    public function ActiveObjections()
    {
        return $this->morphMany('Modules\CommunicationManagement\Entities\Objection', 'objectionable')->where('resolved', false);
    }
}
