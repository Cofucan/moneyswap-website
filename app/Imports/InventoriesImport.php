<?php

namespace App\Imports;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class InventoriesImport implements ToCollection, WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {            
          
            $product = Product::where('sku', $row['sku'])->firstOrFail();
            if($product->Inventory()->exists())
            {
                $product->inventory->increment('quantity', $row['quantity']);
                
            }else{
                $inventory = Inventory::create([
                    'product_id'     => $product->id,
                    'quantity'  => $row['quantity'],
                    'minimum_stock'    => !empty($row['minimum_stock']) ? $row['minimum_stock'] : 0,
                    'reorder_quantity'  => !empty($row['reorder_quantity']) ? $row['reorder_quantity'] : 0, 
                ]);
            }        

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
