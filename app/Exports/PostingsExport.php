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

class PostingsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $id;
    protected $from_date;
    protected $to_date;

    function __construct($groupid, $from_date,$to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->groupid= $groupid;
    }

    public function query()
    {

        $queryString = 'TXN-GRP-POSTING';

        $data = DB::table('transactions_financial')->whereBetween('txn_date', [$this->from_date, $this->to_date])
            ->select('batch_number', 'group_type', 'member_phone_number', 'amount', 'txn_id', 'txn_type', 'maker_phone_number', 'approval_type', 'destination_account', 'group_account')
            ->where('txn_category',  $queryString)
            ->where('group_id',  $this->groupid )
            ->orderBy('id');

            dd($data);
        return $data;
    }

    public function title(): string
    {
        return 'Group Postings';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Batch No.',
            'Group Type',
            'Member Phone',
            'Amount',
            'Transaction ID',
            'Transaction Type',
            'Initiator No',
            'Type of Approval',
            'Destination Account',
        ];
    }
}
