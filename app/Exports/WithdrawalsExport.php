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

class WithdrawalsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $group_number;
    protected $from_date;
    protected $to_date;

    function __construct($from_date,$to_date, $groupid, $withdrawal_type)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->groupid= $groupid;
        $this->withdrawal_type= $withdrawal_type;

    }

    public function query()
    {
        $data = DB::table('transactions_withdrawal')->whereBetween('txn_date', [$this->from_date, $this->to_date])
            ->select('batch_number', 'group_type', 'member_phone_number', 'amount', 'txn_id', 'txn_type', 'destination_account', 'maker_phone_number', 'approval_type')
            ->where('group_id',  $this->groupid )
            ->where('withdrawal_type', $this->withdrawal_type)
            ->orderBy('id');

        return $data;

    }

    public function title(): string
    {
        return 'Withdrawals';
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
            'Batch No.',
            'Group Type',
            'Member Phone',
            'Amount',
            'Transaction ID',
            'Transaction Type',
            'Destination Account',
            'Initiator No',
            'Type of Approval'
        ];

    }

}
