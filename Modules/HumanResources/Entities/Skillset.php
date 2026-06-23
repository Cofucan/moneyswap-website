<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class Skillset extends Model
{
    //

    public function Vacancies()
    {
        return $this->BelongsToMany('Modules\HumanResources\Entities\Vacancy');
    }
}
