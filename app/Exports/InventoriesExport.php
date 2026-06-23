<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;

class InventoriesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inventory::with('Product')->get();
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Product Name',
            'Available Quantity',
            'Reserved Quantity',
          //  'Units',
            'Low Stock Threshold',
            'Reorder Quantity',           
            'Updated at'
        ];
    }

  
    public function map($inventory): array
    {
        return [
            $inventory->Product->sku,
            $inventory->Product->label,
            $inventory->quantity,
            //$inventory->Product->uom,
            $inventory->blocked,
            $inventory->low_stock,
            $inventory->reorder,            
            Date::dateTimeToExcel($inventory->updated_at)
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
               // $cellRange = ‘A1:’.$event->sheet->getDelegate()->getHighestColumn().’1′;
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
