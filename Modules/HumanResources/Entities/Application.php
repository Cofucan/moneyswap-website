<?php

namespace Modules\RecruitmentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
class Application extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'vacancy_id',
        'application_ref',
        'profile_id',
        'cover_letter',
        'application_date',
        'availability_date', // when can you start
        'status' // wish, Applied, Reviewed,Shortlisted , Rejected, Test, InterviewInvitation, Cancled, Employeed
    ];

    public function Vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }


    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }
    public function Resume()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Resume');
    }
}
