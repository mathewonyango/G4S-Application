<?php

namespace App\Http\Controllers;

use App\Client;
use App\Corporate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CorporatesController extends Controller
{
    public function index(){
        $corporates = DB::table('corporates')
            ->join('corporate_contacts', 'corporates.corporate_id', '=', 'corporate_contacts.corporate_id')
            ->select('corporates.*', 'corporate_contacts.*')
            ->get();
            // dd($corporates);
        return view('corporate.index', compact('corporates'));
    }
    public function create(){

        return view('corporate.create');
    }
    //new code

public function assignRider(Request $request){

        $riders = DB::table('rider')->get();

    $corporate_id = $request->get('corporate_id');
   
     $corporate_name=DB::table('corporates')->where('corporate_id', $corporate_id )->value('name');

        $supervisors=DB::table('users')->where('type','Admin')->get();
        // dd($supervisors);
        

        return view('corporate.Assign_rider_form',compact('riders','supervisors','corporate_id'));
    }
	
	 public function postRider(Request $request){


        $corporate_id = $request->input('corporate_id');
    //   dd(  $corporate_id);
   
        $corporate_name=DB::table('corporates')->where('corporate_id', $corporate_id )->value('name');
// dd($corporate_name);
        $from = $request->input('from');
        $rider = $request->input('rider');
      
        $supervisorID = $request->input('supervisorID');

        $supervisor_phone = DB::table('users')->where('id', $supervisorID)->value('phonenumber');
        $address = urlencode($from);
        // $address_2 = urlencode($to);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCEjBbsyUIo9kbClk3Up7ufHO0pEhaI88M";
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);
        if ($resp['status'] == 'OK') {
            $lat_from = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi_from = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        }


        DB::table('rider')
        ->where('id', $rider)
        ->update([
            'latitude' => $lat_from,
            'longitude' => $longi_from,
            'supervisor_contact' => $supervisor_phone,
            'corporate'=> $corporate_name
        ]);
        return redirect()->back();
        }

    public function createRegion(){

        $regions = DB::table('regions')->paginate(5);
        

        return view('collection-process.region',compact('regions'));
    }



    public function addregions(Request $request)
    {
        
        $name = $request->input('town_name');
        $user_id  = user()->id;
       
       
        DB::table('regions')->insert([
            'town_name' => $name,      
        ]);
       $branch =  DB::table('Branches')->insert([
            'Company' => "G4S", 
            'BranchName' =>$name,
            'createdBy' =>$user_id,
            'createdDate' => Carbon::now(),

        ]);
		
     flash()->info('Success. Record Saved   successfully');
	 return redirect()->route('corporate.indexRegion');

    }

    public function  indexRegion(){

        return view('collection-process.region');
    }
	
	
    
  public function  mapRegion()
    {


        // $regions = DB::table('regions')->paginate(5);
        $maps=DB::table('region_based_price')->paginate(5);

        return view('collection-process.maps', compact('maps'));
    }

    public function showAddMap(){

         $regions = DB::table('regions')->paginate(5);

        return view('collection-process.create_map', compact('regions'));
    }
   

   

    public function region(){
        
        return view('collection-process.create_region');

    }


    public function addMap(Request $request)
{
    $from = $request->from;
    $to = $request->to;

    DB::table('region_based_price')->insert([
        'from' => $from,
        'to' => $to,
        'price' => $request->price,
    ]);
	 flash()->info('Success. Region Mapped successfully');
	 return redirect()->route('corporate.mapRegion');



}
    public function addCorporate(Request $request){
        // dd($request->all());
        $name = $request->get('name');
        $address = $request->get('address');
        $email = $request->get('email');
        $phonenumber = $request->get('phonenumber');
        $designation = $request->get('designation');
        $location = $request->get('location');
        $contact_person = $request->get('contact_person');
        $otherCon = uniqid();
        $other_con2 = substr($otherCon, 2,5);
        $corporate = substr($name, 0, 2);
        $corporate_id = strtoupper($corporate.''.$other_con2);

        $this->validate($request, [
            'name' => 'min:5|required',
            'address' => 'min:5|required',
            'email' => 'email|required',
            'phonenumber' => 'required',
            'contact_person' => 'min:10',
        ]);

        $data = [
            "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "ADDCORP",
            "corporate_id"=> "$corporate_id",
            "name"=> "$name",
            "location"=> "$location",
            "physical_address"=> "$address",
            "email"=> "$email",
            "contact_persons"=> [
                   [
                    "contact_person"=> "$contact_person",
                    "phone_number"=>"$phonenumber",
                    "designation"=> "$location"
                   ]
            ],
            "channel"=> "PORTAL"
           ];
           $post = json_encode($data);
           $result = json_decode(curl($data));
           if($result->responseCode === '000'){
            flash()->info('Success');
            return redirect()->route('corporate.show');
           }else{
            flash()->error('Unable to add Corporate Client');
            return redirect()->back();
           }
    }
    public function getusersForm(Request $request){
        $id = $request->input('corporate_id');
        $data = [
            "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "CORP_DETAILS",
            "corporate_id"=> "$id",
            "channel"=> "PORTAL"
           ];
           $post = json_encode($data);
           $result = json_decode(curl($data));
        //    dd($result);
        return view('corporate.admins', compact('id'));
    }
    public function getBalance(){
        $user = Auth::user()->corporate_id;
        $data = [
         "username"=> "courier",
         "password"=> "CoUrier2021",
         "processingCode"=> "BI_CORP",
         "corporate_id"=> "$user",
         "channel" => "PORTAL"
        ];

        $post = json_encode($data);
        $result = json_decode(curl($data));

        // $rides ==
        $balance = $result->balance;
        $acc = $result->accountNumber;

        $data_rides = [
            "username"=> "courier",
           "password"=> "CoUrier2021",
           "processingCode"=> "CORP_HIST",
           "corporate_id"=> "$user",
           "channel"=> "PORTAL"
       ];

       $posted = json_encode($data_rides);
       $my_rides = json_decode(curl($data_rides));
    //    dd($my_rides->data);

        flash()->info('Success, Check your outstanding balance below');
        return view('corporate.bills', compact('my_rides', 'balance', 'acc'));
    }
    public  function getRideHistory(){


        $user = Auth::user()->corporate_id;
        // dd($user);
        $data = [
             "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "CORP_HIST",
            "corporate_id"=> "$user",
            "channel"=> "PORTAL"
        ];

        $post = json_encode($data);
        $result = json_decode(curl($data));

        if($result->responseCode === '000'){
            $rides = $result->data;
            // dd($rides);
            return view('employees.ride-history', compact('rides'));
        }else{
        flash()->error('No Trip history found');
            return redirect()->back();
        }

    }
    //EDU EMPLOYEES
    public  function edit($client_id){
        $corporate_client = Client::find($client_id);
        return view('clients.edit', compact('corporate_client'));
    }
    public  function update(Request $request, $client_id){
        $corporate_client = $request->all();
        $phone = $request->get('phonenumber');
        $email = $request->get('email');
        $is_active = $request->get('is_active');

        $corporate_client = Client::find($client_id);
        $my_id = $corporate_client->client_id;
        $new_update = DB::table('client')
                        ->where('client_id', $my_id)
                        ->update(['is_active' => $is_active,
                                    'phone_number' => $phone,
                                    'email' => $email,
                            ]);
        flash()->info('Update and change successful');
        return redirect()->route('client.get-employees');

    }
    public  function delete($client_id){
        $corporate_client = Client::find($client_id);
        flash()->error('Note that the action can not be undone. You have successfully deleted');
        Client::destroy($client_id);
    }
    //sms and notifications
    public  function sendSMSToOne(){
        return view('corporate.sendOneSMS');
    }
    public  function sendBulkSMS(){
        return view('corporate.sendBulkSMS');
    }
    public  function retrieveMessages(){
        $query = DB::table('corporate_messages')->get();
        return view('corporate.retrieve-mssgs', compact('query'));
    }

    public function actionCorporates($id){
        $corporate = Corporate::find($id);
        $corporate_status = $corporate->status;
        $reg_id =  $corporate->corporate_id;
        if($corporate_status == 0){
            $update_corporate = DB::table('corporates')
                ->where('corporate_id', '=', $reg_id)
                ->update([
                    'status' => 1,
                ]);

            $query = DB::table('users')
                ->where('corporate_id', '=', $reg_id)
                ->update([
                    'active' => 1,
                    'status' => 1,
                ]);
            flash()->info('Success, The Corporate Client has been  Activated, Their users therefore can access our services');
            return redirect()->route('corporate.show');
        }
        else{
            $update_corporate = DB::table('corporates')
                ->where('corporate_id', '=', $reg_id)
                ->update([
                    'status' => 0,
                ]);

            $query = DB::table('users')
                ->where('corporate_id', '=', $reg_id)
                ->update([
                    'active' => 0,
                    'status' => 0,
                ]);
            flash()->error('Success, The Corporate Client has been deactivated, Their users therefore can not access our services');
            return redirect()->route('corporate.show');
        }

    }

}
