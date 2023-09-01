<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\FromCollection;
use Excel;
use App\MpesaStatement;
use App\Trip;
use App\Shipments;
use Carbon\Carbon;
use App\Exports\ShipmentExport;
use App\Exports\statusExport;
use App\Exports\corporateFinancialReportExport;
use App\Exports\branchExport;
use App\Exports\paymentExport;
use App\Exports\GroupExport;
use App\Exports\MembersExport;
use App\Exports\PostingsExport;
use App\Exports\WithdrawalsExport;
use App\Exports\TransactionReport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ReportsController extends Controller
{
    // public function Groups(){
    //     $allgroups = DB::table('groups')->paginate(15);
    //     return view('reports.showgroups', compact('allgroups'));
    // }
    // public function downloadAllGroups(Request $request)
    // {
    //     try {
    //         $this->validate($request, [
    //             'from_date' => 'required',
    //             'to_date' => 'required'
    //         ]);
    //     } catch (ValidationException $e) {
    //     }

    //     trail('Get groups', 'fetch all groups with range- date');

    //     $from_date = $request->get('from_date');
    //     $to_date = $request->ge-t('to_date');
    //     return Excel::download(new GroupExport($from_date, $to_date),  'Groups as at '. Carbon::now().'.xlsx');
    // }
    // public function Members(){
    //     $allmembers = DB::table('member_group')->paginate(15);
    //     $groups = DB::table('groups')->get();
    //     $members = DB::table('member_group')
    //     ->join('users', 'member_group.maker', '=', 'users.id')
    //     ->join('groups', 'member_group.group_number', '=', 'groups.group_number')
    //     ->select('member_group.*', 'users.firstname as creator', 'member_group.maker as maker2', 'groups.group_name')
    //     ->get();
    //     dd($members);
    //     return view('reports.members', compact('allmembers', 'groups', 'members'));
    // }
    // public function downloadMembers(Request $request)
    // {
    //     $this->validate($request, [
    //         'group_number' => 'required'
    //     ]);

    //     trail('Get members', 'fetch all members with group number');

    //     $group_number = $request->get('group_number');
    //     return Excel::download(new MembersExport($group_number),  'Members as at '. Carbon::now().'.xlsx');
    // }
    // public function Postings(){

    //   $allpostings = DB::table('transactions_financial')
    //                 ->where('txn_category', 'TXN-GRP-POSTING')
    //                 ->join('groups', 'transactions_financial.group_id', '=', 'groups.id')
    //                 ->select('transactions_financial.*','groups.group_name')
    //                 ->get();

    //     $groups = DB::table('groups')->get();
    //     return view('reports.grouppostings', compact('groups', 'allpostings'));
    // }
    // public function downloadPostings(Request $request)
    // {

    //     $this->validate($request, [
    //         'groupid' => 'required',
    //         'from_date' => 'required',
    //         'to_date' => 'required'
    //     ]);

    //     trail('Get postings for group', 'fetch all postings with group number');

    //     $from_date = $request->get('from_date');
    //     $to_date = $request->get('to_date');
    //     $groupid = $request->get('groupid');

    //     return Excel::download(new PostingsExport($groupid, $from_date,$to_date  ),  'Group postings as at '. Carbon::now().'.xlsx');
    // }
    // public function Withdrawals(){
    //     $allwithdrawals = DB::table('transactions_withdrawal')->paginate(15);
    //     $groups = DB::table('groups')->get();
    //     $data = DB::table('transactions_withdrawal')
    //         ->join('groups', 'transactions_withdrawal.group_id', '=', 'groups.id')
    //         ->select('transactions_withdrawal.*', 'groups.group_name')
    //         ->get();

    //     return view('reports.withdrawals', compact('allwithdrawals', 'groups', 'data'));
    // }
    // public function downloadWithdrawals(Request $request)
    // {
    //     $this->validate($request, [
    //         'groupid' => 'required',
    //         'from_date' => 'required',
    //         'to_date' => 'required',
    //         'withdrawal_type'=>'required'
    //     ]);

    //     trail('Get withdrawals', 'fetch withdrawals based on parameters');

    //     $groupid = $request->get('groupid');
    //     $from_date = $request->get('from_date');
    //     $to_date = $request->get('to_date');
    //     $withdrawal_type = $request->get('withdrawal_type');
    //     return Excel::download(new WithdrawalsExport( $from_date,$to_date, $groupid, $withdrawal_type),  'Withdrawals as at '. Carbon::now().'.xlsx');
    // }

    public function showMpesaStatement()
    {

        $all_transactions = DB::table('C2B')->orderBy('CreatedAt', 'DESC')->get();
        // dd($all_transactions);

        return view('reports.mpesa', compact('all_transactions'));
    }
    public function showIncome()
    {
        $all_incomes = DB::table('C2B')->orderBy('CreatedAt', 'DESC')->paginate(10);
        $total_amount = DB::table('C2B')->sum('TransactionAmount');

        return view('reports.income', compact('all_incomes', 'total_amount'));
    }
    public function showSuccesfulTrips()
    {
        $all_trips = DB::table('trip')->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('reports.trips', compact('all_trips'));
    }
    public function showSuccessfulClients()
    {
        $all_clients = DB::table('client')->orderBy('created_at', 'DESC')->paginate(10);
        // dd($all_clients);
        return view('reports.client', compact('all_clients'));


    }

    public function filterStatement(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $all_transactions =  MpesaStatement::whereBetween('CreatedAt', [$start_date, $end_date])->get();

        return view('reports.mpesa', compact('all_transactions'));
    }

    public function filterIncome(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $all_incomes=  MpesaStatement::whereBetween('CreatedAt', [$start_date, $end_date])->get();

        return view('reports.income', compact('all_incomes'));
    }

    public function filterTrip(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $all_trips =  Trip::whereBetween('created_at', [$start_date, $end_date])->get();

        return view('reports.trip', compact('all_trips'));
        
    }

    public function filterShipment(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();
       
        $all_shipments= DB::table('shipments')->whereBetween('created_at', [$start_date, $end_date])->get();
        return view('collection-process.shipment_reports', compact('all_shipments'));
    }

    public function showAllShipment()
    {
        $all_shipments = DB::table('shipments')->orderBy('created_at', 'DESC')->paginate(10);

        $branches=DB::table('Branches')->get();
        
        
        return view('collection-process.shipment_reports', compact('all_shipments','branches'));
    }

    public function paymentReport()
    {
        $all_shipments = DB::table('shipments')->orderBy('created_at', 'DESC')->paginate(10);

        $branches=DB::table('Branches')->get();
        
        
        return view('collection-process.payment_report', compact('all_shipments','branches'));
    }
    public function statusReport()
    {
        $all_shipments = DB::table('shipments')->orderBy('created_at', 'DESC')->paginate(10);        
        return view('collection-process.status_report', compact('all_shipments'));
    }

    public function branchReport()
    {
        
        $all_shipments = DB::table('shipments')->orderBy('created_at', 'DESC')->paginate(10);
        $regions = DB::table('regions')->get();
        return view('collection-process.branch_report', compact('all_shipments', 'regions'));
    }

    public function filterClient(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $all_clients =  MpesaStatement::whereBetween('CreatedAt', [$start_date, $end_date])->get();

        return view('reports.client', compact('all_clients'));
    }



    public function importExportView()
    {
        return view('import');
    }

    public function ExportExcel($mpesa_statement)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($mpesa_statement);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="MpesaStatements_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function export()
    {
        $all_transactions = DB::table('C2B')->orderBy('CreatedAt', 'DESC')->get();
        $data_array[] = array("FirstName", "MiddleName", "MSISDN", "TransactionType", "TransactionID", "TransactionAmount", " InternalReference", "CreatedAt");
        foreach ($all_transactions as $data_item) {
            $data_array[] = array(
                'FirstName' => $data_item->FirstName,
                'MiddleName' => $data_item->MiddleName,
                'MSISDN' => $data_item->MSISDN,
                'TransactionType"' => $data_item->TransactionType,
                'TransactionAmount' => $data_item->TransactionAmount,
                'InternalReference' => $data_item->InternalReference,
                'CreatedAt' => $data_item->CreatedAt
            );
        }
        $this->ExportExcel($data_array);
    }
    function exportIncome()
    {
        $all_incomes = DB::table('C2B')->orderBy('CreatedAt', 'DESC')->get();
        $data_array[] = array("FirstName", "MiddleName", "MSISDN", "TransactionType", "TransactionID", "TransactionAmount", "  BusinessShortCode", "CreatedAt");
        foreach ($all_incomes as $data_item) {
            $data_array[] = array(
                'FirstName' => $data_item->FirstName,
                'MiddleName' => $data_item->MiddleName,
                'MSISDN' => $data_item->MSISDN,
                'TransactionType"' => $data_item->TransactionType,
                'TransactionAmount' => $data_item->TransactionAmount,
                'InternalReference' => $data_item->BusinessShortCode,
                'CreatedAt' => $data_item->CreatedAt
            );
        }
        $this->ExportExcelIncome($data_array);
    }

    public function ExportExcelIncome($incomes)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($incomes);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="incomes_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    //client report export
    function exportClient()
    {
        $all_clients = DB::table('client')->orderBy('created_at', 'DESC')->get();
        $data_array[] = array("client_id", "fullname", "phone_number", "email", " is_active", "client_type", "  corporate_id", "created_at");
        foreach ($all_clients as $data_item) {
            $data_array[] = array(
                'client_id' => $data_item->client_id,
                'fullname' => $data_item->fullname,
                'phone_number'  => $data_item->phone_number,
                'email' => $data_item->email,
                ' is_active'  => $data_item->is_active,
                'client_type'  => $data_item->client_type,
                'corporate_id' => $data_item->corporate_id,
                'created_at'  => $data_item->created_at
            );
        }
        $this->ExportExcelClient($data_array);
    }

    public function ExportExcelClient($client)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($client);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="client_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

  

    function exportRider()
    {
        $all_trips = DB::table('trip')->orderBy('created_at', 'DESC')->get();
        $data_array[] = array("pickup_address", "dropoff_address", "type_of_trip ", " trip_cost ", "started_time", "end_time", "payment_type", "delivery_date", "reciever_name", "reciever_phone", "trip_code", "created_at", "paid");
        foreach ($all_trips as $data_item) {
            $data_array[] = array(
                'pickup_address' => $data_item->pickup_address,
                'dropoff_address' => $data_item->dropoff_address,
                'type_of_trip' => $data_item->type_of_trip,
                'trip_cost'  => $data_item->trip_cost,
                'started_time' => $data_item->started_time,
                'end_time' => $data_item->end_time,
                'payment_type' => $data_item->payment_type,
                'delivery_date' => $data_item->delivery_date,
                'receiver_name' => $data_item->receiver_name,
                'reciever_phone' => $data_item->receiver_phone,
                'trip_code'  => $data_item->trip_code,
                'created_at'  => $data_item->created_at,
                'paid'  => $data_item->paid
            );
        }
        $this->ExportExcelRider($data_array);
    }

//     public function ExportExcelRider($rider)
//     {
//         ini_set('max_execution_time', 0);
//         ini_set('memory_limit', '4000M');
//         try {
//             $spreadSheet = new Spreadsheet();
//             $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
//             $spreadSheet->getActiveSheet()->fromArray($rider);
//             $Excel_writer = new Xls($spreadSheet);
//             header('Content-Type: application/vnd.ms-excel');
//             header('Content-Disposition: attachment;filename="rider_ExportedData.xls"');
//             header('Cache-Control: max-age=0');
//             ob_end_clean();
//             $Excel_writer->save('php://output');
//             exit();
//         } catch (Exception $e) {
//             return;
//         }
//     }

//     function exportShipment(Request $request)
// {

    
    
//     $this->validate($request, [
    
//         'start_date' => 'required',
//         'end_date' => 'required'
//     ]);

//     trail('Shipment Report', 'download Shipment report');

//     $start_date = $request->start_date;

    
//     $end_date = $request->end_date;

//     return Excel::download(new ShipmentExport($start_date, $end_date), 'Shipment Report as at '. Carbon::now(). '.xlsx');
// }

public function exportShipment(Request $request)
{
    $this->validate($request, [
        'from_date' => 'required',
        'to_date' => 'required'
    ]);

    $from_date = Carbon::parse($request->from_date)->toDateTimeString();
    $to_date = Carbon::parse($request->to_date)->toDateTimeString();
  
 
 

    return Excel::download(new ShipmentExport($from_date, $to_date), 'Shipment-Report as at ' . Carbon::now() . '.xlsx');
}
public function paymentExport(Request $request)
{
    $this->validate($request, [
        'from_date' => 'required',
        'to_date' => 'required',
        'paymentMethod'=>'required',
       
    ]);
   

  

    $fromDate = Carbon::parse($request->from_date)->toDateTimeString();
    // dd( $fromDate);
    $toDate = Carbon::parse($request->to_date)->toDateTimeString();
    $paymentMethod = $request->paymentMethod;
    // dd($paymentMethod);

    

    return Excel::download(new paymentExport($paymentMethod,$fromDate, $toDate), 'payment-Report as at ' . Carbon::now() . '.xlsx');
}
public function statusExport(Request $request)
{
    $this->validate($request, [
        'from_date' => 'required',
        'to_date' => 'required',
       
    ]);
   
    $status = $request->status;
    // dd($paymentMethod);
    //dd($status);

    $fromDate = Carbon::parse($request->from_date)->toDateTimeString();
    // dd( $fromDate);
    $toDate = Carbon::parse($request->to_date)->toDateTimeString();
   
    

    return Excel::download(new statusExport($status,$fromDate, $toDate), 'payment-Report as at ' . Carbon::now() . '.xlsx');
}
public function branchExport(Request $request)
{
    $this->validate($request, [
        'from_date' => 'required',
        'to_date' => 'required',
       
    ]);
   
    $branch = $request->branch;
    // dd($branch);

    $fromDate = Carbon::parse($request->from_date)->toDateTimeString();
    // dd( $fromDate);
    $toDate = Carbon::parse($request->to_date)->toDateTimeString();
   
    

    return Excel::download(new branchExport($branch,$fromDate, $toDate), 'branch-Report as at ' . Carbon::now() . '.xlsx');
}

public function branchFinancialReport(Request $request){


    $fromDate = Carbon::parse($request->from_date)->toDateTimeString();
   
    $toDate = Carbon::parse($request->to_date)->toDateTimeString();

    $corporates=DB::table('corporates')->get();

    $all_shipments = DB::table('shipments')->orderBy('created_at', 'DESC')->paginate(10);
  
    return view('collection-process.corporate_financial_report', compact('all_shipments','corporates'));

}



public function CorporateFinancialReportExport(Request $request){



    $this->validate($request, [
        'from_date' => 'required',
        'to_date' => 'required',
       
    ]);
   
    $corporate = $request->corporate;
    // dd($branch);

    // dd($corporate);

    $fromDate = Carbon::parse($request->from_date)->toDateTimeString();
    // dd( $fromDate);
    $toDate = Carbon::parse($request->to_date)->toDateTimeString();
  



    return Excel::download(new corporateFinancialReportExport($corporate,$fromDate, $toDate), 'corporate-Report as at ' . Carbon::now() . '.xlsx');
}



    // public function ExportExcelShipment($shipment)
    // {
    //     ini_set('max_execution_time', 0);
    //     ini_set('memory_limit', '4000M');
    //     try {
    //         $spreadSheet = new Spreadsheet();
    //         $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
    //         $spreadSheet->getActiveSheet()->fromArray($shipment);
    //         $Excel_writer = new Xls($spreadSheet);
    //         header('Content-Type: application/vnd.ms-excel');
    //         header('Content-Disposition: attachment;filename="Shipments_ExportedData.xls"');
    //         header('Cache-Control: max-age=0');
    //         ob_end_clean();
    //         $Excel_writer->save('php://output');
    //         exit();
    //     } catch (Exception $e) {
    //         return;
            
    //     }
    // }

    public function shipments(Request $request){
        $shipments = DB::table('shipments')->get();

        // $shipments = Shipments::where('status', $status)
        //     ->limit(10)
        //     ->orderBy('created_at', 'DESC')
        //     ->get();
        // $agentType = AgentType::all()->pluck("name", "id");
        // $branch = DB::table('branch')->pluck("name", "branch_code");
        return view('reports.shipment', compact('shipments'));
    }

    public function downloadShipment(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        trail('Transactions Report', 'download transaction report');

        // $branch = $request->get('branch_name');
        $status = $request->get('agent_type');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        return Excel::download(new TransactionReport($status,$from_date, $to_date), 'Shipment Report as at '. Carbon::now(). '.xlsx');
    }

}
