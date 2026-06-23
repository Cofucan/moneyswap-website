<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeopleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Person([
            //
            'salutation'     => $row['salutation'],
            'last_name'    => $row['last_name'],
            'first_name'    => ucfirst($row['first_name']),
            'middle_name'    => $row['middle_name'],
            'birthday'    => $row['birthday'],
            'gender'    => $row['gender'],
            'marital_status'    => $row['marital_status'],
            'birthplace'    => $row['birthplace'],
            'religion'    => $row['religion'],
            'primary_language'    => $row['primary_language'],
            'nationality'    => $row['nationality'],
            'state_of_origin'    => $row['state_of_origin'],
            'birth_sequence'    => $row['birth_sequence'],
            'passport_photo'    => $row['passport_photo'],
        ]);
    }
    public function batchSize(): int
    {
        return 200;
    }
    public function chunkSize(): int
    {
        return 50;
    }
}
