<?php

namespace App\Http\Controllers;

use App\Client;
use App\Corporate;
use App\Rider;
use App\Trip;
use App\User;
use App\Shipments;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemAdminController extends Controller
{
    public function index()
    {
        $corporate_id = Auth::user()->corporate_id;
        $branch = user()->branch;
        $pending_status= 3;
        $variance = 2;

        if (auth()->user()->type === 'super-admin' || auth()->user()->type === 'Admin') {
        $all_shipments = Shipments::all()->count();
         $shipments_delivered = Shipments::all()->where('status', 5)->count();
         $dispatch = Shipments::all()->where('status', 3)->count();
         $transit = Shipments::all()->where('status', 4)->where('status', 6)->count();
         $pending = DB::table('shipments')->where('status','<', $pending_status)->count();
         $variance =  DB::table('shipments')->where('variance','>', $variance)->count();

        //  dd($pending);

         $shipments_undelivered = Shipments::all()->where('status', '!=' , 5)->count();
    } else if (auth()->user()->type === 'Collection Officer' || auth()->user()->type === 'Sorting Officer') {
        $all_shipments = Shipments::all()->where('from',$branch)->count();
        $shipments_delivered = Shipments::all()->where('status', '5')->where('from',$branch)->count();
        $shipments_undelivered = Shipments::all()->where('status', '!=' , 5)->where('from',$branch)->count();
        $dispatch = Shipments::all()->where('status', 3)->where('from',$branch)->count();
        $transit = Shipments::all()->where('status', 3)->where('from',$branch)->count();
        $pending = DB::table('shipments')->where('status','<', $pending_status)->where('from',$branch)->count();
        $variance =  DB::table('shipments')->where('variance','>', $variance)->where('from',$branch)->count();


    } else if (auth()->user()->type === 'corporate') {
        $all_shipments = Shipments::all()->where('corporate_id',$corporate_id)->count();
        $shipments_delivered = Shipments::all()->where('status', '5')->where('corporate_id',$corporate_id)->count();
        $shipments_undelivered = Shipments::all()->where('status', '!=' , 5)->where('corporate_id',$corporate_id)->count();
        $pending_corporate = Shipments::all()->where('status', '!=' , 5)->where('corporate_id',$corporate_id)->count();
        $success_corporate = Shipments::all()->where('status', '!=' , 5)->where('corporate_id',$corporate_id)->count();
        $dispatch = Shipments::all()->where('status', 3)->where('corporate_id',$corporate_id)->count();
        $transit = Shipments::all()->where('status', 3)->where('corporate_id',$corporate_id)->count();
        $pending = DB::table('shipments')->where('status','<', $pending_status)->count();
        $variance =  DB::table('shipments')->where('variance','>', $variance)->count();

    }
    
        // dd(Auth::user()->corporate_id);
        $corporate_id = Auth::user()->corporate_id;
        $employees = DB::table('client')->where('corporate_id', $corporate_id)->count();
        $deactivated_employees = DB::table('client')
                           ->where('corporate_id', $corporate_id)
                           ->where('is_active', 0)
                           ->count();

        // dd($deactivated_employees);

        $active_riders = Rider::where('is_online', 1)->count();
        $inactiveUserCount = User::where('active', 0)->count();
        $registeredUsers = User::all()->count();
        $all_trips = Trip::all()->count();
        $active_corporates = Corporate::where('status', 1)->count();
        $inactive_corporates = Corporate::where('status',0)->count();
        $allClients = Client::all()->count();
        $inactiveClients = Client::where('is_active',0)->count();



        $chart_clients = (new LarapexChart)->pieChart()
            ->setTitle('Corporates Summary')
            ->addData([
                Corporate::where('status', 1)->count(),
                Corporate::where('status', 0)->count()
            ])
            ->setColors(['#00FF00', '#ff6384'])
            ->setLabels(['Active Corporates', 'Inactive Corporates']);

        //Registration vs Parcels Sent
        $chart = (new LarapexChart)->barChart()
            ->setHeight(300)
            ->setTitle('Monthly Summary of Registrations vs Parcel Sent')
            ->addData('Registered Users', [12,24, 15, 2])
            ->addData('Sent Parcel', [7, 2, 35, 2])
            ->setColors(['#00FF00', '#ff6384'])
            ->setXAxis(['Week 1', 'Week 2', 'Week 3', 'Week 4']);

        //corporate

        $chart_corporates = (new LarapexChart)->lineChart()
            ->setHeight(300)
            ->setTitle('Weekly Report(Parcel, Pending vs On Transit vs Delivered)')
            ->addData('Pending Parcels', [6,4, 1, 2, 4, 4, 7])
            ->addData('Delivered', [0, 1, 0, 0, 5, 2, 1])
            ->addData('On Transit', [3, 4, 5, 7, 1, 4, 4])

            ->setColors(['#00FF00', '#ff6384','#0000FF'])
            ->setXAxis(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);

        $chart_data = (new LarapexChart)->pieChart()
            ->setTitle('My Corporate Summary')
            ->addData([
                Corporate::where('status', 1)->count(),
                Corporate::where('status', 0)->count()
            ])
            ->setColors(['#FF0000', '#8B0000'])
            ->setLabels(['Active Corporates', 'Inactive Corporates']);

        $logged = Auth::user()->type;
        return view('dashboard', compact('variance','all_shipments','logged', 'deactivated_employees', 'employees', 'chart_clients', 'active_corporates', 'allClients','chart','active_riders', 'all_trips', 'chart_corporates', 'chart_data', 'shipments_undelivered','shipments_delivered','pending', 'dispatch','transit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
