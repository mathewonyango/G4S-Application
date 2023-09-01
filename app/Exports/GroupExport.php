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

class GroupExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $from_date;
    protected $to_date;

    function __construct($from_date,$to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function query()
    {
        $data = DB::table('groups')->whereBetween('created_at', [$this->from_date, $this->to_date])
            ->select( 'group_name',
            'group_number',
            'group_type',
            'status',
            'created_at',
            'created_by')
            ->orderBy('id');
        return $data;

    }

    public function title(): string
    {
        return 'Groups';
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
            'Group Name',
            'Group Number',
            'Group Type',
            'Group Status',
            'Date Created',
        ];

    }

}
