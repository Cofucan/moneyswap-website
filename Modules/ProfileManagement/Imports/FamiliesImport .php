<?php

namespace Modules\ProfileManagement\Imports;

use Modules\ProfileManagement\Traits\SponsorTrait;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FamiliesImport implements ToCollection, WithHeadingRow
{
    use SponsorTrait;
    /**
    * @param array $row
    *
    *
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $this->data)
        {
            return $this->saveFamily();
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
