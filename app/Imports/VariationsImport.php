<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VariationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            //
            'product_id'     => $row['product_id'],
            'label'    => $row['label'],
            'sku'    => rand(1111,9999),
            'store_visibility'    => $row['store_visibility'],
            'cash'    => $row['cash'],
            'coin'    => $row['coin'],
            'featured'    => $row['featured'],
            'display_image'    => $row['display_image'],
            'thumbnail'    => $row['thumbnail'],
            'remark'    => $row['remark'],
            'is_default'    => $row['is_default'],            
        ]);
    }
    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 30;
    }
}
