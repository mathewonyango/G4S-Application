<?php

namespace App\Http\Controllers;

use App\Trip;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(){

        $trips = DB::table('trip')->orderBy('created_at','DESC') ->paginate(15);
        $client = DB::table('client')->get();
        $rider = DB::table('rider')->get();
        $data = DB::table('trip')
                    ->join('client', 'trip.client_email' ,'=', 'client.email')
                    ->join('rider', 'trip.rider_email' , '=', 'rider.email')
                    ->select('trip.*', 'firstname', 'lastname', 'phonenumber','fullname', 'phone_number')
                    ->get();

        return view('Unpaid_trips.list', compact('trips','client','rider','data'));
    }

    public function listUnpaidTrips(){

        $trips = DB::table('trip')->orderBy('created_at','DESC') ->paginate(15);
        $client = DB::table('client')->get();
        $rider = DB::table('rider')->get();
        $data = DB::table('trip')
                    ->join('client', 'trip.client_email' ,'=', 'client.email')
                    ->join('rider', 'trip.rider_email' , '=', 'rider.email')
                    ->select('trip.*', 'firstname', 'lastname', 'phonenumber','fullname', 'phone_number')
                    ->get();

        return view('Unpaid_trips.index', compact('trips','client','rider','data'));
    }


  public function tripPayment(Request $request){
      return view('Unpaid_trips.create');
  }
     
   public function updateTripPayment(Request $request){

        $user = Auth::user()->id;
        // $trip_id = $request->input('trip_id');
        $transaction_id = $request->input('transaction_id');

        $data = [
            
                "username" => "courier",
                "password" =>"CoUrier2021",
                "processingCode" => "100100",
                "trip_id" => "trip_id",
                "transaction_id" => "$transaction_id",
                "channel" => "ANDROID",
                "created_by" => "$user"

        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        if($result->responseCode === '000'){
            flash()->success('payment added succesfully');
            return redirect()->route('trip.index');
        }else{
            flash()->error('Unable to add payment');
            return redirect()->route('trip.index');
        }

   }


    // public  function update(Request $request){
    //     $validated = $request->validate([
    //         'mpesa_reference' => 'required',
    //         'trip_cost' => 'required'
    //     ]);
    //     $mpesa_reference = $request->get('mpesa_reference');
    //     $trip_cost = $request->get('trip_cost');

    //     $query = DB::table('trip')->insert([
    //         'mpesa_reference' => $mpesa_reference,
    //         'trip_cost'=> $trip_cost
            
    //     ]);
        
    //         flash()->info('Trip payment added successfully. ');
    //         return redirect()->route('trip.index');
     
    //     }

}