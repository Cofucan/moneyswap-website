<?php

namespace Modules\HumanResources\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'subject_category_i',
        'proficiency',
        'Profile_id',
    ];

    public function SubjectCategory()
    {
        return $this->belongsTo('Modules\CurriculumManagement\Entities\SubjectCategory');
    }

    public function Profile()
    {
        return $this->belongsTo('Modules\ProfileManagement\Entities\Profile');
    }

    public function Endoresements()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Resume');
    }

}
