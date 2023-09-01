<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MembersExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $group_number;

    function __construct($group_number)
    {
        $this->group_number = $group_number;

    }

    public function query()
    {
        $data = DB::table('member_group')
            ->where('group_number', $this->group_number)
            ->select('group_number','firstname', 'lastname','phonenumber', 'group_number', 'idnumber', 'accounts', 'status')
            ->orderBy('mgid');

        return $data;

    }

    public function title(): string
    {
        return 'Members';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Group Number',
            'First Name',
            'Last Name',
            'Member Phone',
            'Group Number',
            'ID Number',
            'Account',
            'Member Status',

        ];

    }

}
