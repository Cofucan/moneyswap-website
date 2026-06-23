<?php

namespace Modules\LocationManagement\Exports;

use Modules\LocationManagement\Entities\City;
use Maatwebsite\Excel\Concerns\FromCollection;

class CitiesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return City::all();
    }
}
