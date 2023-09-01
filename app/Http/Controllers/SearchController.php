<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\MpesaStatementModel;
use App\Trip;
use App\view;
use Illuminate\Support\Facades\Route;
use Validator, Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
// use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
class SearchController extends Controller
{
    	
    public function findSearch(Request $request){
        $search = $request->input("search");
        // dd($search);	
        $trips = Trip::query()
                    ->where('pickup_address' , 'LIKE', "%$search%")
                    ->orWhere ('dropoff_address', 'LIKE', "%$search%")
                    ->orWhere ('type_of_trip', 'LIKE', "%$search%")
                    ->orWhere ('type_of_trip', 'LIKE', "%$search%")
                    -> orWhere ('receiver_name', 'LIKE', "%$search%")          
                    ->orWhere ('receiver_phone', 'LIKE', "%$search%")
                    ->orWhere ('trip_code', 'LIKE', "%$search%")
                    ->get ();
       
         return view ( 'reports.searchTrip' ,compact('trips'));   

    }   	

    //search mpesa statemnt
    public function findTransaction(Request $request){
        $search = $request->input("search");	
        $transactions = MpesaStatementModel::where  ('FirstName', 'LIKE', "%$search%" )
                        ->orWhere ( 'MiddleName', 'LIKE', "%$search%")
                        ->orWhere ( 'MSISDN', 'LIKE', "%$search%")
                        ->get ();	
    
         return view ( 'reports.searchTransactionResults' ,compact('transactions'));
        

    }   
    //search trips function
    public function findTrip(){
        return view('reports.client');	
    }
    
    public function findSearchTrip(Request $request){
        $search = $request->input("search");	
  
        $trips = TripModel::where  ( 'pickup_address', 'LIKE', '%' . $search . '%' )->orWhere ( 'dropoff_address', 'LIKE', '%' . $search . '%' )->orWhere ( 'type_of_trip ', 'LIKE', '%' . $search . '%' )->orWhere ( 'payment_type ', 'LIKE', '%' . $search . '%' )->orWhere ( 'trip_code', 'LIKE', '%' . $search . '%' )->orWhere ( 'receiver_name', 'LIKE', '%' . $search . '%' )->orWhere ( 'dropoff_address', 'LIKE', '%' . $search . '%' )->orWhere ( 'type_of_trip ', 'LIKE', '%' . $search . '%' )->orWhere ( 'payment_type ', 'LIKE', '%' . $search . '%' )->orWhere ( 'trip_code', 'LIKE', '%' . $search . '%' )->orWhere ( 'receiver_phone', 'LIKE', '%' . $search . '%' )->get ();	
          if (count ( $trips ) > 0)
        // dd($clients);
         return view ( 'reports.searchTrip' ,compact('trips'));

        else
         return view ( 'reports.searchTrip')->withMessage ( 'No Details found. Try to search again !' );	

    } 
    public function findIncome(){
        return view('reports.client');	
    }
    
    public function findSearchIncome(Request $request){
        $search = $request->input("search");	
  
        $incomes = IncomeModel::where ('FirstName', 'LIKE', '%' . $search . '%' )->orWhere ( 'MiddleName', 'LIKE', '%' . $search . '%' )->orWhere ( 'MSISDN', 'LIKE', '%' . $search . '%' )->get ();	
          if (count ( $incomes ) > 0)
        // dd($clients);
         return view ( 'reports.searchIncome' ,compact('incomes'));

        else
         return view ( 'reports.searchIncome')->withMessage ( 'No Details found. Try to search again !' );	

    } 

    
}