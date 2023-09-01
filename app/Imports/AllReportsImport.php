<?php

namespace App\Imports;
use App\AllReports;
use Maatwebsite\Excel\Concerns\ToModel;
class AllReportsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AllReports([
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'MSISDN' => $row['MSISDN'],
            'TransactionType' => $row['TransactionType'],
            'TransactionID' => $row['TransactionID'],
            'TransactionTime' =>$row['TransactionTime'],
            'TransactionAmount' =>$row['TransactionAmount'],
            'BusinessShortCode' =>$row['BusinessShortCode'],
            'BillRefNumber' =>$row['BillRefNumber'],
            'OrgAccountBalance' =>$row['OrgAccountBalance'],
            'Status' =>$row['Status'],
            'ThirdPartyTransId' =>$row['ThirdPartyTransId'],
            'CreatedAt' =>$row['CreatedAt'],
            'UpdatedAt' =>$row['UpdatedAt'],
            'InternalReference' =>$row['InternalReference']
            
        ]);
    }
}
