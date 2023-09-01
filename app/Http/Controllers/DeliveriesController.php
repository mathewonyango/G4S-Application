<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveriesController extends Controller
{
    public function deliveredTrips(){
        $trips = DB::table('trip')
            ->where('status', '=', 'FULFILLED')
            ->join('client', 'trip.client_email', '=', 'client.email')
            ->paginate(15);
        return view('deliveries.delivered',compact('trips'));
    }
    public function deliveryOnTransit(){
        $trips = DB::table('trip')
            // ->where('status', '=', 'STARTED')
            ->where('status', '=', 'STARTED')
            ->join('client', 'trip.client_email', '=', 'client.email')
            ->paginate(50);
        // dd($trips);
        return view('deliveries.on-transit', compact('trips'));
    }
    public function deliveryDisputed(){
        $trips = DB::table('trip')
            ->where('status', '=', 'CANCELLED')
            ->join('client', 'trip.client_email', '=', 'client.email')
            ->paginate(15);
        return view('deliveries.disputed', compact('trips'));
    }
    public function requestedTrips(){
        $trips = DB::table('trip')
            ->where('status', '=', 'REQUESTED')
            // ->orWhere('status', '=', 'ALLOCATED')
            ->join('client', 'trip.client_email', '=', 'client.email')
            ->paginate(15);
        // dd($trips);
        return view('deliveries.requested', compact('trips'));
    }
}
 