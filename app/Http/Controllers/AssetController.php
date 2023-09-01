<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\DB;


class AssetController extends Controller
{ 

    public static function timestamp()
    {
        return date('YmdHis');
    }
    public function index(){

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "ALL_BIKES",
            "channel" => "PORTAL"
        ];
     
        $post = json_encode($data);
        $result = json_decode(curl($data));

       
        if($result->responseCode === '000'){

            $bikes = $result->data;
            flash()->success('Success');
            return view('assets.index', compact('bikes'));
        }else{
            $data = [
                "username"=> "g4scourier",
                "password"=> "M)Cash2020%Key",
                "processingCode"=> "ALL_BRANCHES",
                "channel"=> "PORTAL"
                ];

            $post = json_encode($data);
            $result = json_decode(curl($data));
              flash()->error('No bikes found. Register below');
        return view('assets.register-bike', compact('result'));
        }
    }

    public function getAllBranches(){

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "ALL_BRANCHES",
            "channel"=> "PORTAL"
            ];

        $post = json_encode($data);
        $result = json_decode(curl($data));
        if($result->responseCode === '000'){
            return view('assets.branches', compact('result'));
        }else{
            flash()->error('No data found. Add a new branch');
            return view('assets.new-branch');
        }

    }

    public function createBranchForm(){
        return view('assets.new-branch');
    }

    public function submitBranchName(Request $request){
        // dd($request->all());
        $user = Auth::user()->id;
        $branch_name = $request->input('branch_name');
        $company_name = $request->input('company_name');

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "CREATE_BRANCH",
            "company_name"=> "$company_name",
            "branch_name"=>"$branch_name",
            "created_by"=> "$user",
            "channel"=> "PORTAL"
            ];

        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if($result->responseCode === '000'){
            flash()->success('Successfully created');
            return redirect()->route('asset.all-branches-assets');
        }else{
            flash()->error('Unable to create Branch');
            return redirect()->back();
        }
    }


    public function createBikeForm(){
        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "ALL_BRANCHES",
            "channel"=> "PORTAL"
            ];

        $post = json_encode($data);
        $result = json_decode(curl($data));

        return view('assets.register-bike', compact('result'));
    }

    public function registerBike(Request $request){

        // dd($request->all());

        $branch = $request->input('branch');
        $insurance_Company = $request->input('insurance_Company');
        $purchase_cost = $request->input('purchase_cost');
        $color = $request->input('color');
        $supplier = $request->input('supplier');
        $brand = $request->input('brand');
        $engine_capacity = $request->input('engine_capacity');
        $bike_make = $request->input('bike_make');
        $numberplate = $request->input('numberplate');
        $reg_no = $request->input('reg_no');
        $insurance_no = $request->input('insurance_no');
        $insurance_expiry = $request->input('insurance_expiry');
        $chasis_no = $request->input('chasis_no');
        $insurance_cert = $request->file('insurance_cert')->getClientOriginalName();
        $path_insurance_conduct = $request->insurance_cert->storeAs('uploads', $insurance_cert, 'public');
        $loggedin_userid = Auth::user()->id;

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "CREATE_BIKE",
            "brand"=> " $brand",
            "make"=> "$bike_make",
            "model" => "$numberplate",
            "engine_capacity"=> " $engine_capacity",
            "purchase_cost"=> "$purchase_cost",
            "supplier_name"=> "$supplier",
            "color"=> " $color",
            "insurance_company"=> "$insurance_Company",
            "branch"=> "$branch",
            "number_plate" => "$reg_no",
            "chassis_number" => "$chasis_no",
            "insurance_number" => "$insurance_no",
            "insurance_expiry" => "$insurance_expiry ",
            "insurance_upload"=> "$path_insurance_conduct",
            "created_by" => "$loggedin_userid",
            "channel" => "PORTAL"
        ];

        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if($result->responseCode === '000'){
            flash()->success('Successfully retrieved');
            return redirect()->route('asset.list-bikes');
        }else{
            flash()->error('Unable to fetch motorbikes');
            return redirect()->back();
        }
    }

    public function registerAsset(Request $request){

        // dd($request->all());

        $request->validate([
            'region' => 'required',
            'insurance_Company' => 'required',
            'purchase_cost' => 'required',
            'color' => 'required',
            'supplier' => 'required',
            'brand' => 'required',
            'engine_capacity' => 'required',
            'bike_make' => 'required',
            'numberplate' => 'required',
            'reg_no' => 'required',
            'insurance_no' => 'required',
            'insurance_expiry' => 'required',
            'chasis_no' => 'required',
            'insurance_cert' => 'required|file',
        ]);


        $branch = $request->input('branch');
        $insurance_Company = $request->input('insurance_Company');
        $purchase_cost = $request->input('purchase_cost');
        $color = $request->input('color');
        $supplier = $request->input('supplier');
        $brand = $request->input('brand');
        $engine_capacity = $request->input('engine_capacity');
        $bike_make = $request->input('bike_make');
        $numberplate = $request->input('numberplate');
        $reg_no = $request->input('reg_no');
        $insurance_no = $request->input('insurance_no');
        $insurance_expiry = $request->input('insurance_expiry');
        $chasis_no = $request->input('chasis_no');
        $insurance_cert = $request->file('insurance_cert')->getClientOriginalName();
        $path_insurance_conduct = $request->insurance_cert->storeAs('uploads', $insurance_cert, 'public');
        $loggedin_userid = Auth::user()->id;

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "CREATE_BIKE",
            "brand"=> " $brand",
            "make"=> "$bike_make",
            "model" => "$numberplate",
            "engine_capacity"=> " $engine_capacity",
            "purchase_cost"=> "$purchase_cost",
            "supplier_name"=> "$supplier",
            "color"=> " $color",
            "insurance_company"=> "$insurance_Company",
            "branch"=> "$branch",
            "number_plate" => "$reg_no",
            "chassis_number" => "$chasis_no",
            "insurance_number" => "$insurance_no",
            "insurance_expiry" => "$insurance_expiry ",
            "insurance_upload"=> "$path_insurance_conduct",
            "created_by" => "$loggedin_userid",
            "channel" => "PORTAL"
        ];

        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if($result->responseCode === '000'){
            flash()->success('Successfully retrieved');
            return redirect()->route('asset.list-assets');
        }else{
            flash()->error('Unable to fetch assets');
            return redirect()->back();
        }
    }


    public function createAssetForm(){
        
        $regions=DB::table('regions')->get();
		
   
        return view('assets.register-assets', compact('regions'));
    }

    public function AssetIndex(){

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "ALL_BIKES_ALLOCATE",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        dd($result);
		 $regions=DB::table('regions')->get();
        if($result->responseCode === '000'){

            $bikes = $result->data;
            flash()->success('Success');
            return view('assets.show-assets', compact('bikes','regions'));
        }else{
            $data = [
                "username"=> "g4scourier",
                "password"=> "M)Cash2020%Key",
                "processingCode"=> "ALL_BRANCHES",
                "channel"=> "PORTAL"
                ];

            $post = json_encode($data);
            $result = json_decode(curl($data));
              flash()->error('No bikes found. Register below');
        return view('assets.register-assets', compact('result','regions'));
        }
    }



    public function unAllocated(){

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "ALL_BIKES",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if($result->responseCode === '000'){
            $bikes = $result->data;
            flash()->success('Successfully');
            return view('assets.unallocated', compact('bikes'));
        }else{
            flash()->error('No data retrieved');
            return redirect()->back();
        }
    }

    public function assignBikeForm(Request $request){   

        $user = Auth::user()->id;
        $bike_id = $request->input('bike_id'); 
        $bikes = DB::table('bike')->get();  
        $riders = DB::table('rider')
        ->where('dob', '!=', '1900-01-01')
        ->get();
        
        // $riders = DB::table('rider')->get();

        return view('assets.assign-bike', compact('bikes','bike_id','riders'));
    }
    

    public function confirmAssignBike(Request $request){
        $this -> validate($request, [
                'bike_id' => 'required',
                'rider_id' => 'required',
                'start_mileage' => 'required',

        ]);
        $bike_id = $request->input('bike_id');
        $start_mileage = $request->input('start_mileage');
        $rider_id = $request->input('rider_id');
        $time_in = $request->input('time_in');

        $user = Auth::user()->id;
        // $user = Auth::user()->created_by;

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "BIKE_RIDER_ALLOCATE",
            "bike_id" => $bike_id,
            "rider_id" => "$rider_id",
            "start_mileage" => "$start_mileage",
            "created_at" => "$time_in",
            "created_by" => "$user",
            "channel" => "PORTAL"
        ];
      
        
        $post = json_encode($data);
        $result = json_decode(curl($data));
        dd($result);

        if($result->responseCode === '000'){
            flash()->success('Success');
            return redirect()->route('asset.list-bikes');
        }else{
            flash()->error('Unable to assign');
            return redirect()->back();
        }

    }
    public function returnBikeForm(Request $request){
        // dd($request->all());
        $user = Auth::user()->id;
        $bike_id = $request->input('bike_id');
        $end_mileage = $request->input('end_mileage');
        $recieved_by = $request->input('recieved_by');
        $created_at = $request->input('created_at');
        $riders = DB::table('rider')
        ->where('dob', '!=', '1900-01-01')
        ->get();
        return view('assets.return-bike', compact('bike_id','recieved_by','end_mileage','riders','created_at'));

    }
    
    public function confirmReturnBike(Request $request){
        $bike_id = $request->input('bike_id');
        $rider_name = $request->input('rider_name');
        $recieved_by = $request->input('recieved_by');
        $end_mileage = $request->input('end_mileage');
        $created_at = $request->input('created_at');
        //dd($rider_name);
        $user = Auth::user()->id;
        // dd($user);

        $data = [  
                "username" => "g4scourier",
                "password" => "M)Cash2020%Key",
                "processingCode" => "BIKE_RIDER_RETURN",
                "allocation_id" => "$allocation_id",
                "end_mileage" => "$end_mileage",
                "recieved_by" => "$recieved_by",
                "created_at" => "$created_at",
                "created_by" => "$user",
                "channel" => "PORTAL"


                // "allocation_id" => "16",
                // "end_mileage" => "510",
                // "received_by" => "4",
                 // "channel" => "PORTAL"
            
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));

        if($result->responseCode === '000'){
            flash()->success('Success');
            return redirect()->route('asset.list-bikes');
        }else{
            flash()->error('Unable to assign');
            return redirect()->route('asset.un-allocated');
        }

    }
    public function fuelForm(Request $request){
        $bike_id = $request->input('bike_id');
          return view('assets.add-fuel', compact('bike_id'));
    }

    public function serviceForm(Request $request){
        $bike_id = $request->input('bike_id');
        return view('assets.add-service', compact('bike_id'));
    }
    public function submitFuelForm(Request $request){
        $user = Auth::user()->id;
        $bike_id = $request->input('bike_id');
        $date_fuel = $request->input('date_fuel');
        $amount = $request->input('amount');
        $station = $request->input('station');

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "BIKE_FUELING",
            "bike_id" => "$bike_id",
            "station" => "$station",
            "amount" => "$amount",
            "fueling_date" => "$date_fuel",
            "created_by" => "$user",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if($result->responseCode === '000'){
            flash()->success('Success');
            return redirect()->route('asset.list-bikes');
        }else{
            flash()->error('Unable to submit fuel charges');
            return redirect()->route('asset.list-bikes');
        }

    }
    public function submitServiceForm(Request $request){
        $user = Auth::user()->id;
        $bike_id = $request->input('bike_id');
        $service_date = $request->input('service_date');
        $amount = $request->input('amount');
        $description = $request->input('station');
        $responsible_person = $request->input('responsible_person');


        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "BIKE_SERVICE",
            "bike_id" => "$bike_id",
            "description" => "$description",
            "amount" => "$amount",
            "service_date" => "$service_date",
            "service_by" => "$responsible_person",
            "created_by" => "$user",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if($result->responseCode === '000'){
            flash()->success('Success');
            return redirect()->route('asset.list-bikes');
        }else{
            flash()->error('Unable to submit fuel charges');
            return redirect()->route('asset.list-bikes');
        }
    }

    public function getFuelHistory(Request $request){
        $bike_id = $request->input('bike_id');

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "BIKE_FUELING_HISTORY_BIKE",
            "bike_id" => "$bike_id",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data)); 
        if($result->responseCode === '000'){
            return view('assets.fuel-history', compact('result'));
        }else{
            flash()->error('Data not found');
            return redirect()->back();
        }
    }
    public function getServiceHistory(Request $request){
        $bike_id = $request->input('bike_id');

        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "BIKE_SERVICE_HISTORY_BIKE",
            "bike_id" => "$bike_id",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        if($result->responseCode === '000'){
            return view('assets.service-history', compact('result'));
        }else{
            flash()->error('Data not found');
            return redirect()->back();
        }

    }

    public function getRidersHistory(Request $request){
        $bike_id = $request->input('bike_id');
        $start_mileage = $request->input('start_mileage');


        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "BIKE_ALLOCATION_HISTORY_BIKE",
            "bike_id" => "1",
            "start_mileage" => "$start_mileage",
            "channel" => "PORTAL"

            
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        if($result->responseCode === '000'){
            return view('assets.riders-history', compact('result'));
        }else{
            flash()->error('Data not found');
            return redirect()->back();
        }

    }
}
