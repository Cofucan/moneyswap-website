<?php

namespace App\Exports;

use App\Telephone;
use Maatwebsite\Excel\Concerns\FromCollection;

class TelephonesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Telephone::all();
    }
}
