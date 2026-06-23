<?php

namespace Modules\HumanResources\Imports;

use Modules\HumanResources\Entities\Designation;
use Modules\HumanResources\Entities\EmploymentType;
use Modules\HumanResources\Traits\EmployeeTrait;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class EmployeesImport implements ToCollection, WithHeadingRow
{
    use EmployeeTrait;
    /**
    * @param array $this->data
    *
    * @return \Illuminate\Database\Eloquent\Model|null    */


    public function collection(Collection $rows)
    {
        foreach ($rows as $this->data)
        {
            //dd($this->data);
            set_time_limit(0);
            $this->data['setup'] = !empty($this->data['setup_user']) ? $this->data['setup_user'] : false;
            $this->data['designation_id'] = Designation::byTag($this->data['job_role'])->id;
            // dd($this->data['designation_id']);
            $this->data['employment_type_id'] = EmploymentType::byTag($this->data['employment_type'])->id;
            // dd($this->data['employment_type_id']);
            if ( ! $this->saveEmployee()) {
                return redirect()->back()->withInput()->withErrors('Data Entry Error');
            }
        }
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
