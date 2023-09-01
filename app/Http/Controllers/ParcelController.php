<?php

namespace App\Http\Controllers;

use App\User;
use App\Rider;
use App\Shipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParcelController extends Controller
{
    //
	public static function timestamp()
    {
        return date('YmdHis');
    }
    public function showParcels()
    {
        $branch = user()->branch;

        $parcels = DB::table('shipments')->where('from',$branch)->orderByDesc('id')->paginate(10);
        return view('collection-process.index', compact('parcels',));
    }
	
	  public function showParcelsCorporate()
    {

        $corporate_id = user()->corporate_id;

        $parcels = DB::table('shipments')->where('corporate_id',$corporate_id)->orderByDesc('id')->paginate(10);
        return view('collection-process.index', compact('parcels',));
    }

    public function addParcel(Request $request)
    {
		$user = Auth::user();
        $userRegion = $user->branch;
        $region = DB::table('regions')->where('id', $userRegion)->get(); 
		$regions = DB::table('regions')->get();	
		return view('collection-process.initiate', compact('regions','region'));
    }
    public function calculatePrice(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $type = $request->get('type');
        $weight = $request->get('weight');
        $quantity = $request->get('quantity');
        $corporate_id = User::where('corporate_id', '!=', NULL)->get();
     
        $user_type = user()->type;


        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'quantity' => 'required',
        ]);

        if(!empty($corporate_id)){
            dd($corporate_id);
        // if($user_type === 'corporate'){
            flash()->info('Great!.  Record Fetched  Successful');
            return view('collection-process.parcel_details', compact('from', 'to', 'type', 'weight', 'quantity','corporate_id'));
        }else

        $query = [
            "username" => "g4scourier",
            "password" => "M)Cash2020%Key",
            "processingCode" => "CALCREGPRC",
            "from" => "$from",
            "to" => "$to",
            "weight" => "$weight",
            "quantity" => "$quantity",
        ];
		

        $post = json_encode($query);
		
        $result = json_decode(curl($query));
	
		
        $price = $result->price;
        
        if ($result->response == '000') {
            flash("Great!" . $result->responseDescription)->success();
            return view('collection-process.parcel_details', compact('from', 'to', 'type', 'weight', 'quantity', 'price'));
        } else {
            flash()->error('Not Successful. Try again');
            return redirect()->back();
        }
        
    }


    public function postParcel(Request $request)
    {
        $logged = Auth::user()->corporate_id;
        $user_fname = Auth::user()->firstname;
        $user_lname = Auth::user()->lastname;
		 $user_id= Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $type = $request->input('type');
        $weight = $request->input('weight');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $weight = $request->input('weight');
        $quantity = $request->input('quantity');
        $sender = $request->input('sender');
        $sender_phone = $request->input('sender_phone');
        $receiver = $request->input('receiver');
        $receiver_phone = $request->input('receiver_phone');
        $user_fname = Auth::user()->firstname;
        $user_lname = Auth::user()->lastname;
		$shipment_id = Shipments::count()+1;
        $parcel_id= 'G4S000'.($shipment_id + 1);
		$paymentMethod = $request->input('paymentMethod');
        $mpesaCode = $request->input('mpesaCode');
		$sender_id = $request->input('sender_id');
        $receiver_id = $request->input('receiver_id');
        $corporate_id = Auth::user()->corporate_id;

        $data = [
                "username" =>"g4scourier",
                "password"=> "M)Cash2020%Key",
                "processingCode"=> "CRTSHPMNT",
                "parcelId" => "$parcel_id",
                "from" => "$from",
                "type" => "$type",
                "to" => "$to",
                "weight" => "$weight",
                "quantity" => "$quantity",
                "sender" => "$sender",
                "senderPhone" => "$sender_phone",
                "receiver" => "$receiver",
                "receiverPhone" => "$receiver_phone",
                "price" => "$price",
                "maker" => "$user_id",
                "sorting" => "0",
                "dispatch" => "0",
                "status" => "0",
				"paymentMethod" => "$paymentMethod",
                "mpesaCode" => "$mpesaCode",
				"senderId"=> "$sender_id",
                "receiverId" => "$receiver_id",
                "corporateId" =>"$corporate_id",      
        ];


        $post = json_encode($data);
        $result = json_decode(curl($data));

        if ($result->response == '000') {
			
           
            flash("shipment added successfully")->success();
            return redirect()->route('parcel.index');
        } else {
            flash("System timed out. Try again in minutes")->error();
            return redirect()->back();
        }
            
        
    }

     public function sortingReceive(Request $request)
    {

        $action = $request->get('action');
        $id = $request->get('id');
		 $user_id= Auth::user()->id;
        $parcel_id = $request->get('parcel_id');
        $user_fname = Auth::user()->firstname;
        $user_lname = Auth::user()->lastname;
        $riders = DB::table('rider')->get();
        $variance = $request->get('variance');


        if ($action == 'receive') {

            $query_update = DB::table('shipments')->where('id', $id)->update([
                'status' => 1,
                'sorting' => $user_id,
                'variance' =>$variance,

            ]);
           // dd($query_update);
            flash("Great! shipment received for sorting")->success();
            return redirect()->back();
        } else{
            flash("Failed! shipment not received for sorting")->danger();
            return redirect()->back();
		}
	}
     


    public  function dispatchParcel(Request $request){
        $parcel_id= $request->parcel_id;
        $riders = DB::table('rider')->get();
        return view('collection-process.dispatch', compact('parcel_id', 'riders'));
    }
    public  function postDispatch(Request $request){
        $data = $request->all();
        $id = $request->get('id');
		 $user_id= Auth::user()->id;
        $user_fname = Auth::user()->firstname;
        $user_lname = Auth::user()->lastname;
        $rider = $request->input('rider');
        $deriverytype = $request->input('deliverytype');
        $parcel_id = $request->input('parcel_id');
        $action = $request->input('action');

        if ($action == 'dispatch'){
            $query = DB::table('shipments')->where('parcel_id', $parcel_id)->update([
                'status' => 2,
                'dispatch' => $user_id,
                'rider' => $rider,
                'deliverytype' => $deriverytype,
            ]);

           // dd($query);
            if ($query) {
                flash("shipment added successfully")->success();
                return redirect()->route('parcel.index');
            } else {
                flash("Record not updated")->error();
                return redirect()->route('parcel.index');
            }

        }else {
            flash("System timed out. Try again in minutes")->error();
            return redirect()->back();
        }
        

       
    }  
       public function search(Request $request){
                $search = $request->input('search');
                $parcels = Shipments::when($search, function($sql) use ($search) {
                    $sql->where('parcel_id', 'like', '%' . $search . '%');
                })
                ->paginate(5);

                return view('collection-process.index', compact('parcels',));
            }   	
}
