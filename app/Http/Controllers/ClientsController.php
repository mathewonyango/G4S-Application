<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    public function create(){
        return view('clients.create');
    }
    public function showClients(){
        // $clients = Client::paginate();
        // $clients = Client::orderBy('client_id', 'ASC');
         $clients = DB::table('client')->orderBy('client_id', 'ASC')->paginate(10);
         

        return view('clients.index', compact('clients'));
    }
    public function registerClient(){
        return view('clients.register');
    }
    public function postClientSelf(Request $request){
        $fullname = $request->get('fullname');
        $email = $request->get('email');
        $phonenumber = $request->get('phone_number');

        $this->validate($request, [
            'fullname'=> 'required',
            'email'=> 'required',
            'phone_number' => 'required',
        ]);

        $query = [
            "username"=> "courier",
            "password" =>"CoUrier2021",
            "processingCode"=> "ADDCLNT",
            "fullname" => "$fullname",
            "phonenumber" => "$phonenumber",
            "email" => "$email",
            "channel" => "WEB",
        ];
        $post = json_encode($query);
        $result = json_decode(curl($query));
        // dd($result);
        $client_email =$result->email;
        if ($result->responseCode == '000') {
            flash()->info('Success, You have successfully registered. Check your phone or email for OTP');
            return view('clients.validateOTP', compact('client_email'));
        } else {
            flash()->error('Not Successful. Try again');
            return view('clients.register');
        }
    }
    public function validateOTP(){
        return view('clients.validateOTP');
    }
    public function postOTPValidation(Request $request){
        $otp = $request->get('otp');
        $otp_trim = trim($otp);
        $email = $request->get('email');

        $this->validate($request, [
            'otp'=> 'required',
        ]);
        $query = [
            "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "OTPVAL",
            "phone_number" => "$email",
            "otp" => "$otp_trim",
            "channel" => "ANDROID"
        ];

        $post = json_encode($query);
        $url = 'http://3.127.53.160:8770/channelinterface/courier';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($post),
        ));
        $result =  json_decode(curl_exec($ch));
        curl_close($ch);
        if ($result->responseCode == '000') {
            flash()->info('Success, Verified. You can now book a parcel trip');
            return redirect()->route('index');
        } else {
            flash()->error('Not Successful. Wrong details.Try again');
            return view('clients.register');
        }
    }
    public function showEmployees(){
        $logged = Auth::user()->corporate_id;
        // $employees = Client::where('corporate_id','=', $logged)->get();
        $employees = DB::table('client')
                    ->where('corporate_id','=', $logged)->get();
        return view('employees.index', compact('employees'));
    }
    public function postClient(Request $request){
        $logged = Auth::user()->corporate_id;
        // dd($logged);
        $fullnames = $request->get('fullnames');
        $email = $request->get('email');
        $phonenumber = $request->get('phonenumber');
        $department = $request->get('department');
        $corporate_id = $logged;

        $data = [
            "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "ADDCLNTCORP",   
            "fullname" => "$fullnames",
            "phonenumber" => "$phonenumber",
            "email" => "$email",
            "corporate_id" => "$corporate_id",
            "department" => "$department",
            "channel" => "WEB"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);

        if ($result->responseCode == '000') {
            flash()->info('Success, Client successfully added');
            return view('clients.create');
        } else {
            flash()->error('Not Successful. Try again');
            return view('clients.create');
        }

    }
}
