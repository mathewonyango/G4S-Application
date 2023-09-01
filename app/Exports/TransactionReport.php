<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class TransactionReport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents, WithTitle, WithMapping
{
    use Exportable;

  
    protected $from_date;
    protected $to_date;
    protected $status;


    function __construct( $from_date, $to_date)
    {
       
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function query()
    {
        $data = DB::table('shipments')->whereBetween('created_at', [$this->from_date, $this->to_date])
            ->where('status', $this->status)
          
            ->orderBy('id');

        return $data;
    }

    public function title(): string
    {
        return 'Shipment Report ' . Carbon::now();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Parcel ID',
            'Sender Location',
            'Reciever Location',
            'Weight',
            'Quantity',
            'Reciever Name',
            'Sender Name',
            'Amount',
            'Sender Phone',
            'Reciever Phone',
            'Status',
            'Type',
            'Rider',
            'Time Registered',
            'Time Updated',


        ];
    }

    public function map($data): array
    {
        return [
            $data->parcel_id,
            $data->from,
            $data->to,
            $data->weight,
            $data->quantity,
            $data->reciever,
            $data->sender,
            $data->price,
            $data->sender_phone,
            $data->reciever_phone,
            $data->status,
            $data->type,
            $data->rider,
            Carbon::parse($data->created_at)->format('Y-m-d'),
            Carbon::parse($data->created_at)->format('H:i:s')
        ];
    }
}
