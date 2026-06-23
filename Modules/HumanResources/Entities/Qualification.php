<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
class Qualification extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'acronym',
        'label',
        'program_id',
        'published'
    ];
    protected $attributes =
    [
        'published' => true,
    ];

    public function Vacancies()
    {
        return $this->hasMany('Modules\HumanResources\Entities\Vacancy');
    }

    public function Program()
    {
        return $this->belongsTo('Modules\SchoolManagement\Entities\Program');
    }

    public function Employees()
    {
        return $this->hasMany('Modules\HumanResources\Entities\Employee');
    }
    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
    public function scopeByAcronym($query, $acronym)
    {
        return $query->where('acronym', $acronym)->first();
    }

}
