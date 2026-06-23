<?php

namespace App\Exports;

use Modules\ProfileManagement\Entities\Person;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PeopleExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Person::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'Last Name',
            'First Name',
            'Gender',
            'Marital Status',
            'birthday',
            'religion',
            'birthplace',
            'primary_language',
            'nationality',
            'Created at',
            'Updated at'
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
