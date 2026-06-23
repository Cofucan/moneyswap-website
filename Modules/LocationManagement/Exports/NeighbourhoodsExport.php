<?php

namespace Modules\LocationManagement\Exports;

use Modules\LocationManagement\Entities\Neighbourhood;
use Maatwebsite\Excel\Concerns\FromCollection;

class NeighbourhoodsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Neighbourhood::all();
    }
}
