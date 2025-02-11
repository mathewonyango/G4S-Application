<?php

namespace App\Http\Controllers;

use App\Branch;
use App\ProductUpload;
use App\Product;
use Carbon\Carbon;
use App\Shipments;
use App\Timeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;



class BulkUploadController extends Controller
{

    public function addBulk(Request $request){
		$batch_id = DB::table('product')->where('status', 0)->get();
		foreach($batch_id as $b){
	    $get_batch_id = $batch_id[0]->batch_id;
		}
			
        $all_bulk_added_products = ProductUpload::orderBy('created_at', 'desc')->get();


        return view('upload.add-bulk', compact('all_bulk_added_products'));
    }
	
	 public function viewBulkAdmin(Request $request){
		
        // $batch_id = $request->get('batch_id');
        // dd($batch_id);

         $corporate_id = user()->corporate_id;

        $all_bulk_added_products = ProductUpload::orderBy('created_at', 'desc')->where('corporate_id',$corporate_id)->paginate(15);
		


        return view('upload.add-bulk', compact('all_bulk_added_products'));
    }

    public function importProductExcel(Request $request)
    { 
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx,xls'
        ]);
        $file = $request->file('file');
        $password = $request->input('password');
        $email= Auth::user()->email;
        $user_id = Auth::user()->id;
        $batch_id = strtoupper(uniqid('GS'));
        $month = $request->input('month');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        $path = Storage::putFileAs('product', $file, transaction_uniq() . '.' . $extension);
		$corporate_id = user()->corporate_id;


         $credentials = [
                'email' => $email,
                'password' =>  $password,
                'status' => '1'
            ];

            if (Auth::attempt($credentials)) {
               
                    $upload = ProductUpload::create([  
                        'file_name' => $path,
                        'batch_id' =>$batch_id,
                        'uuid' => uuid(),
                        'status' => '0',
                        'stage' => 'checker-approval',
                        'original_file_name' => $fileName,
                        'mime_type' => $mimeType,
                        'extension' => $extension,
                        'disk' => config('filesystems.default'),
                        'size' => $fileSize,
                        'created_by' => user()->id,
                        'maker'=> $user_id,
						'corporate_id'=> $corporate_id,

                    ]);
                   

                    trail('Create',  'bulk import devices to staging');
                    $upload_id = $upload->id;
                    Timeline::create([
                        'upload_id' => $upload_id,
                        'title' => 'Uploaded',
                        'comment' => null,
                        'performed_by' => user()->id
                    ]);
                    $access_path = Storage::disk($upload->disk)->path($upload->file_name);
                    $uploaded_data = (new FastExcel)->import($access_path);
                    $_send = json_decode(json_encode($uploaded_data));
                    foreach ($_send as $object) {
                        restart:
                        $insert_prod = Product::insert([
                            'from' => $object->from,
                            'to' => $object->to,                            
                            'quantity' =>$object->quantity,
                            'sender' =>$object->sender,
                            'reciever' => $object->reciever,
                            'sender_phone' =>$object->sender_phone,
                            'status' => 0,
                            'reciever_phone' =>$object->reciever_phone,
							 'sender_id' =>$object->sender_id,                            
                            'receiver_id' =>$object->receiver_id, 
                            'batch_id' =>$batch_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
							'corporate_id'=> $corporate_id,

        
                        ]);
                        // dd($insert_device);

                    if ($insert_prod  == false) {
                        flash("Not succesful. Try again ")->error();
                        return redirect()->back();
                    }
                }
                if ($insert_prod  == true) {
                    flash()->success('Product Uploaded succesfully');
                    return redirect()->route('bulk.import-admin');

                }else{
                    flash("Not succesful. Try again ")->error();
                    return redirect()->back();
                   } 

                }else{
                    flash()->error('Wrong credentials used. Try again');
                    return redirect()->back();

                }
                
            }
        

   public function collectProduct(Request $request){

	$batch_id = $request->get('batch_id');
    $corporate_id = user()->corporate_id;

    $collect = Product::orderBy('created_at', 'desc')->where('batch_id', $batch_id)->paginate(15);
	return view('upload.collect', compact('collect'));

   }
   
   
   

   public function getParcel(Request $request){
    $to = $request->get('to');
    $from = $request->get('from');
    $quantity = $request->get('quantity');
    $reciever = $request->get('reciever');
    $sender = $request->get('sender');
    $sender_phone = $request->get('sender_phone');
    $reciever_phone = $request->get('reciever_phone');
	 $sender_id = $request->get('sender_id');
    $receiver_id = $request->get('receiver_id');
    $id = $request->get('id');
    
    return view('upload.update-parcel', compact('to', 'id', 'from', 'quantity','reciever','sender','sender_phone', 'reciever_phone','sender_id', 'receiver_id'));
   }

   public function processCollection(Request $request){
        $from = $request->get('from');
        $to = $request->get('to');
        $type = $request->get('type');
        $weight = $request->get('weight');
        $quantity = $request->get('quantity');
        $reciever = $request->get('reciever');
        $reciever_phone = $request->get('reciever_phone');
        $sender_phone = $request->get('sender_phone');
	    $sender_id = $request->get('sender_id');
		$receiver_id = $request->get('receiver_id'); 
        $sender = $request->get('sender');
        $to_id = DB::table('regions')->where('town_name', '=', $to)->first();
        $get_to_id =  $to_id->id;
        $from_id = DB::table('regions')->where('town_name', '=', $from)->first();
        $from_to_id =  $from_id->id;
		 $shipment_id = Shipments::count()+1;
        $parcel_id= 'G4S000'.($shipment_id + 1);
		$id = $request->get('id');
        $user_type = user()->type; 


        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'quantity' => 'required',
        ]);
        if($user_type === 'corporate'){
            flash()->info('Great!.  Record Fetched  Successful');
            return view('upload.confirm',compact('from','id','to','type','get_to_id', 'from_to_id', 'weight', 'quantity','sender_phone','reciever_phone','sender','reciever','parcel_id','sender_id', 'receiver_id'));
        }else

        $query = [
            "username" => "g4scourier",
            "password" => "M)Cash2020%Key",
            "processingCode" => "CALCREGPRC",
            "from" => "$from_to_id",
            "to" => "$get_to_id",
            "weight" => "$weight",
            "quantity" => "$quantity",
        ];
        $post = json_encode($query);
        $result = json_decode(curl($query));
        $price = $result->price;
        if ($result->response == '000') {
            flash("Success. " . $result->responseDescription)->success();
			  $update_status = DB::table('shipments')->where('parcel_id',$parcel_id)->update([
                'status' => 0
               ]); 

            return view('upload.confirm',compact('from','id','to','type','get_to_id', 'from_to_id', 'weight', 'quantity','price','sender_phone','reciever_phone','sender','reciever','parcel_id','sender_id', 'receiver_id'));
        } else {
            flash()->error('Not Successful. Try again');
            return redirect()->back();
        }

   }

   public function confirmDataToDispatch(){
    return view('bulk.confirm');
   }

   
        public function postParcel(Request $request)
        {
            // $logged = Auth::user()->corporate_id;
            // dd($logged);
            $user_fname = Auth::user()->firstname;
            $user_lname = Auth::user()->lastname;
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
            $parcel_id = $request->get('parcel_id');
            $user_id= Auth::user()->id; 
            $sender_id = $request->input('sender_id');
            $receiver_id = $request->input('receiver_id');	
			$id = $request->input('id');
			$paymentMethod = "credit";
           $mpesaCode = $request->input('mpesaCode');
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
			
			
			
			$update_status = DB::table('product')->where('id',$id)->update([
        'status' => 1
    ]);  

                flash("shipment added successfully")->success();
                return redirect()->route('bulk.import');
            } else {
                flash("System timed out. Try again in minutes")->error();
                return redirect()->back();
            }
        }
    public static function timestamp()
    {
        return date('YmdHis');
    }
   
        
    

}