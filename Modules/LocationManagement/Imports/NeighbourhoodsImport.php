<?php

namespace App\Imports;

use Modules\LocationManagement\Entities\Neighbourhood;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\carbon;
class NeighbourhoodsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Neighbourhood([
            //
            'postal_code'     => $row['postal_code'],
            'city_id'    => $row['city_id'],
            'neighbourhood_name'    => ucfirst($row['neighbourhood_name']),
            'population_estimate'    => $row['population_estimate'],
            'longitude'    => $row['longitude'],
            'latitude'    => $row['latitude'],
            'about_neighbourhood'    => $row['about_neighbourhood'],
            'published'    => $row['published'],
        ]);
    }

    public function batchSize(): int
    {
        return 300;
    }
    public function chunkSize(): int
    {
        return 100;
    }
}
