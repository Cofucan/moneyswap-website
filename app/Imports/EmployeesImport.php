<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            //
            'person_id'     => $row['person_id'],
            'employee_number'    => $row['employee_number'],
            'date_employed'    => $row['date_employed'],
            'department_id'    => $row['department_id'],
            'designation_id'    => $row['designation_id'],
            'qualification'    => $row['qualification'],
            'telephone'    => '234'.substr($row['telephone'],-10),
            'email'    => $row['email'],
            'employment_type_id'    => $row['employment_type_id'],
            'outlet_id'    => $row['outlet_id'],
            'status'    => $row['status'],            
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
