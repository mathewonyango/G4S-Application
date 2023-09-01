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

class ShipmentExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents, WithTitle, WithMapping
{
    use Exportable;

    protected $from_date;
    protected $to_date;
    protected $submit;

    public function __construct( $from_date, $to_date)
    {
     
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function query()
    {
        $data = DB::table('shipments')->whereBetween('created_at', [$this->from_date, $this->to_date])
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
            'id',
            'parcel_id',
            'from',
            'to',
            'weight',
            'quantity',
            'sender',
            'sender_phone',
            'sender_id',
            'receiver',
            'receiver_phone',
            'receiver_id',
            'price',
            'maker',
            'sorting',
            'dispatch',
            'status',
            'type',
            'rider',
            'deliverytype',
            'paymentMethod',
            'variance',
           
        ];
    }

    public function map($data): array
    {
        return [
           
            $data->id,
            $data->parcel_id,
            getRegionName($data->from),
            getRegionName($data->to),
            $data->weight,
            $data->quantity,
            $data->sender,
            $data->sender_phone,
            $data->sender_id,
            $data->receiver,
            $data->receiver_phone,
            $data->receiver_id,
            $data->price,
            getMakerName($data->maker),
            getMakerName($data->sorting),
            getMakerName($data->dispatch),
            $data->status,
            $data->type,
            getRiderName($data->rider),
            $data->deliverytype,
            $data->paymentMethod,
            variance( $data->id),
            
        ];
    }
}
