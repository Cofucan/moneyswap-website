<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use Date;
use Carbon\carbon;
class MembersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Member::with('Person', 'MembershipType', 'Person.User')->get();
    }

    public function headings(): array
    {
        return [
            'Roll Number',
            'Membership Code',
            'Full Name',
            'Member Type',
            'Email',
            'Telephone',
            'Registeration Date'
        ];
    }

  
    public function map($member): array
    {
        set_time_limit(0);
        return [
            $member->reference,
            $member->reference_code,
            $member->Person->full_name,
            $member->MembershipType->title_name,
            $member->Person->user->email ?? 'Nil',
            $member->Person->user->telephone ?? 'Nil',
            $member->created_at->format('d-m-Y') ?? 'Nil'
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
