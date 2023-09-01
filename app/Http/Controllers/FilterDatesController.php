<?php

namespace App\Http\Controllers;
use App\Client;
use App\Trip;
use App\IncomeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;


class filterDatesController extends Controller
{
// {
//     public function index()
//     {   
//        return view('reports.client');
//     }

//     public function filterDates(Request $request)
//     {
      
//        $created_at = Carbon::parse($request->created_at)
//                              ->toDateString();

//        $updated_at = Carbon::parse($request->updated_at)
//                              ->toDateString();

//        $all_clients = Client::whereDate('date','<=',$created_at->format('m-d-y'))
//                         ->whereDate('date','>=',$updated_at->format('m-d-y'));

//       return view('reports.client', compact('all_clients'));
// }
// }

//        return Client::whereBetween('created_at',[$start_date,$end_date])->get();

//     }
    
// }
    public function filterDates(Request $request)

    {
      $this -> validate($request, [
         'start_date' => 'required|date',
         'end_date' => 'required|date|before_or_equal:start_date',
           ]);
         
           $start = Carbon::parse($request->created_at);
           $end = Carbon::parse($request->created_at);
         
           $clients = Client::whereDate('date','<=',$end->format('m-d-y'))
           ->whereDate('date','>=',$start->format('m-d-y'));
         
           return view('reports.searchResults', compact('clients'));
    }

    //mpesa- statements
    public function filterTransactions(Request $request)

    {
      $this -> validate($request, [
         'start_date' => 'required|date',
         'end_date' => 'required|date|before_or_equal:start_date',
           ]);
         
           $start = Carbon::parse($request->CreatedAt);
           $end = Carbon::parse($request->CreatedAt);
         
           $transactions = IncomeModel::whereDate('date','<=',$end->format('m-d-y'))
           ->whereDate('date','>=',$start->format('m-d-y'));
         
           return view('reports.searchTransactionResults', compact('transactions'));
    }
    //search trips by date filter

    public function filterTrips(Request $request)

    {
      $this -> validate($request, [
         'start_date' => 'required|date',
         'end_date' => 'required|date|before_or_equal:start_date',
           ]);
         
           $start = Carbon::parse($request->created_at);
           $end = Carbon::parse($request->created_at);
         
           $trips = Trip::whereDate('created_at','<=',$end->format('m-d-y'))
           ->whereDate('created_at','>=',$start->format('m-d-y'));
         
           return view('reports.searchTrip', compact('trips'));
    }
}