<?php

namespace App\Imports;

use App\Models\Product;
use App\Traits\ProductTrait;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Date;
class ProductsImport implements ToCollection, WithHeadingRow
{
    use ProductTrait;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $this->data)
        {
            $product = $this->SaveProduct();           
        }
    }
    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 20;
    }
}
