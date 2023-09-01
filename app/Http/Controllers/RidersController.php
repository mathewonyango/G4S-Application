<?php

namespace App\Http\Controllers;

use App\Client;
use App\Rider;
use Dotenv\Regex\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RidersController extends Controller
{
    public function create()
    {
        $data = [
            "username"=> "g4scourier",
            "password"=> "M)Cash2020%Key",
            "processingCode"=> "ALL_BIKES",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        $bikes = $result->data;
		$roles = DB::table('roles')->where('type', '=', 'app')->get();		
        return view('riders.create', compact('bikes','roles'));
    }
    public function showRiders()
    {
        $riders = Rider::all();
        $riders = DB::table('rider')
                 ->orderBy('id', 'ASC')
                 ->paginate('15');
                //  ->get();

        $bikes = DB::table('bike')->where('status', 0)->get();
        return view('riders.index', compact('riders','bikes'));
    }
    public function addRider(Request $request)
    {

        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $dateofbirth = $request->get('dateofbirth');
        $avatar = $request->get('avatar');
        $krapin = $request->get('krapin');
        $phonenumber = $request->get('phonenumber');
        $gender = $request->get('gender');
        $email = $request->get('email');
        $idnumber = $request->get('idnumber');
        $goodconduct = $request->get('goodconduct');
        $numberplate = $request->get('numberplate');
        $cog_expiry = $request->get('cog_expiry');
        $motor_id = $request->input('motor_id');
        $role = $request->get('role');
		$emp_number = $request->get('emp_number');
     


        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'dateofbirth' => 'required',
            'avatar' => 'required',
            'krapin' => 'required',
            'phonenumber' => 'required',
            'gender' => 'required',
            'idnumber' => 'required',
            'email' => 'required|email',
            'upload_goodconduct' => 'required',
            'goodconduct' => 'required',
            'cog_expiry' => 'required',
			'emp_number' => 'required'

        ]);


        if ($request->hasFile('avatar') && $request->hasFile('upload_goodconduct')) {
            $my_avatars = $request->file('avatar')->getClientOriginalName();
            $path_avatar = $request->avatar->storeAs('uploads', $my_avatars, 'public');

            $my_goodconduct = $request->file('upload_goodconduct')->getClientOriginalName();
            $path_upload_goodconduct = $request->avatar->storeAs('uploads', $my_goodconduct, 'public');


          

            $data = [
                "username"=> "g4scourier",
                "password"=> "M)Cash2020%Key",
                "processingCode"=> "ADDRDR",
                "firstname" => "$firstname",
                "lastname" => " $lastname",
                "avatar" => "$path_avatar",
                "phonenumber" => "$phonenumber",
                "gender" => "$gender",
                "email" => "$email",
                "dob" => "$dateofbirth",
                "idnumber" => "$idnumber",
                "krapin" => "$krapin",
                "goodconduct" => "$path_upload_goodconduct",
                "bike_id" => "$motor_id",
                "role" => "$role",
				"employerNumber" =>"$emp_number",
                "channel" => "PORTAL"
            ];
		
			
            
            $post = json_encode($data);
            $result = json_decode(curl($data));
			

            if ($result->responseCode == 000) {
                flash()->info('Success, Rider successfully registered');
                return redirect()->route('rider.riders');
            } else {
                flash()->error('Some error occured! Error');
                return redirect()->route('rider.create');
            }
        }
    }

    public  function edit($id){
        $rider = Rider::find($id);
        return view('riders.edit', compact('rider'));
    }
    public  function update(Request $request, $id){
        $data = $request->all();
        $phonenumber = $request->get('phonenumber');
        $email = $request->get('email');
        // $numberplate = $request->get('numberplate');
        $status = $request->get('status');


        $rider = Rider::find($id);

        $new_update = DB::table('rider')
                ->where('id', $id)
                ->update([
                    'status' => $status,
                    'phonenumber' => $phonenumber,
                    // 'number_plate' => $numberplate,
                    'email' => $email,
                ]);
        flash()->info('Update and change successful');
        return redirect()->route('rider.riders');
    }
    public  function delete($client_id){
        $corporate_client = Client::find($client_id);
        flash()->error('Note that the action can not be undone. You have successfully deleted');
        Client::destroy($client_id);
    }
    public  function remove($id){
        $rider = Rider::find($id);
//        dd($rider);
        $new_update = DB::table('rider')
            ->where('id', $id)
            ->update([
                'dob' => '',
                'status'=> 0
            ]);
        flash()->info('Successful. The rider successfully removed from the system');
        return redirect()->route('rider.riders');

    }

    public function assgnBike(Request $request){
        $id = $request->get('id');
        $riders = DB::table('rider')->where('id', $id)->get();
        $bike_id = $riders[0]->rider_bike;
        $update_bike  = DB::table('bike')->where('id', $bike_id)->update(['status' =>1]);
        $update_status = DB::table('rider')->where('id', $id)->update(['bike_status' =>1]);

    flash()->info('Successful. The rider successfully Assigned from the system');
    return redirect()->route('rider.riders');


    }

    public function unAssignBike(Request $request){
        $id = $request->get('id');
        $riders = DB::table('rider')->where('id', $id)->get();
        $bike_id = $riders[0]->rider_bike;
        $update_status = DB::table('rider')->where('id', $id)->update(['bike_status' =>0]);
        $update_bike  = DB::table('bike')->where('id', $bike_id)->update(['status' =>0]);
     
    flash()->info('Successful. The rider successfully UnAssigned from the system');
    return redirect()->route('rider.riders');


    }
}