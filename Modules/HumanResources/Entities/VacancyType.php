<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class VacancyType extends Model
{
    //
    protected $fillable = [
        'vacancy_type',
        'vacancy_type_description',
        'published'
    ];

    protected $attributes = [
        'published' => '1',
        ];

    public function Vacancies()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
