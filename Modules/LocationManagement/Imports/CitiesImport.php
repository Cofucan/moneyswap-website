<?php

namespace Modules\LocationManagement\Imports;

use Modules\LocationManagement\Entities\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CitiesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new City([
            //
            'city_name' => $row ['city_name'],
            'city_code' =>  $row['city_code'],
            'about_city'=>  $row['about_city'],
            'state_id'  =>  $row['state_id'],
            'population_estimate' => $row['population_estimate'],
            'longitude' => $row['longitude'],
            'latitude' => $row['latitude'],
            'status'    => $row['status']
        ]);
    }
}
