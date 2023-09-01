<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Subscription;
use App\WebMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function Landing()
    {
        $faqs = Faq::all();
       $data = config('app.GOOGLE_API_KEY');
        return view('landing.index', compact('faqs', 'data'));
    }
    public function Subscribe(Request $request)
    {
        $subscription = $request->all();
        $user_sub = $request->get('email');

        DB::table('subscription')->insert([
            'email' => $user_sub,
            'created_at' => Carbon::now(),
        ]);
        flash()->info('Thanks for being part of AO Logistics Family! ');
        return redirect()->route('index');
    }
    public function getSubscribers()
    {
        $all_subs = Subscription::all();
        return view('landing.subscribers', compact('all_subs'));
    }

    public function sendMessage(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $message = $request->get('message');
        $subject = $request->get('subject');

        DB::table('mssg_web')->insert([
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'subject' => $subject,
            'created_at' => Carbon::now(),
        ]);
        flash()->info('Thanks message received. We shall get back to you ');
        return view('landing.index');
    }
    public function getMessages()
    {
        $all_mssg = WebMessage::orderBy('id', 'DESC')->get();
        return view('landing.from_web', compact('all_mssg'));
    }
    public function bookTrip(Request $request)
    {


        $from = $request->input('from');
        $to = $request->input('to');
        $trip_type = $request->input('trip_type');



        //         Get the Lattitude and longitude of locations START WITH FROM
        $address = urlencode($from);
        $address_2 = urlencode($to);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCEjBbsyUIo9kbClk3Up7ufHO0pEhaI88M";
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);
        if ($resp['status'] == 'OK') {
            $lat_from = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi_from = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        }
        //   Get Lattitude and Longitude of To
        $address_2 = urlencode($to);
        // dd($address_2);
        $url_2 = "https://maps.googleapis.com/maps/api/geocode/json?address={$address_2}&key=AIzaSyCEjBbsyUIo9kbClk3Up7ufHO0pEhaI88M";
        $response_2_json = file_get_contents($url_2);
        $response_2 = json_decode($response_2_json, true);
        if ($response_2['status'] == 'OK') {
            $lat_to = isset($response_2['results'][0]['geometry']['location']['lat']) ? $response_2['results'][0]['geometry']['location']['lat'] : "";
            $longi_to = isset($response_2['results'][0]['geometry']['location']['lng']) ? $response_2['results'][0]['geometry']['location']['lng'] : "";
        }
        $data = [
            $lat_from,
            $longi_from,
            $lat_to,
            $longi_to,
            $address_2,
            $address
        ];

    //    dd($data);


        //get estimate price
        return view('landing.verify-email', compact('lat_from', 'longi_from', 'lat_to', 'longi_to', 'trip_type', 'address_2', 'address'));

        //        return view('landing.confirm', compact('lat_from', 'longi_from', 'lat_to', 'longi_to', 'trip_type'));
    }
    public function bookVerifyEmail(Request $request)
    {
        // dd($request->all());
        $lat_from = $request->input('lat_from');
        $longi_from = $request->input('longi_from');
        $lat_to = $request->input('lat_to');
        $longi_to = $request->input('longi_to');
        $phone = $request->input('phone');
        $trip_type = $request->input('trip_type');


        $this->validate($request, [
            'phone' => 'required',
        ]);
        $data = [

            "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "OTPREQ",
            "phone_number" => "$phone",
            "channel" => "WEB"
        ];

        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if ($result->responseCode == '000') {
            return view('landing.otp-email', compact('phone', 'longi_to', 'lat_to', 'longi_from', 'lat_from', 'trip_type'));
        } else {
            flash()->error('Ooops, You are not registered');
            return view('clients.register');
        }
    }
    public function bookVerifyOTP(Request $request)
    {
        // dd($request->all());
        $otp = $request->input('otp');
        $voucher = $request->input('voucher');
        $longi_from = $request->input('longi_from');
        $longi_to = $request->input('longi_to');
        $lat_to = $request->input('lat_to');
        $lat_from = $request->input('lat_from');
        $phone = $request->input('phone');
        $trip_type = $request->input('trip_type');

        //get estimate
        $estimate = [
            "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "TRIPEST",
            "pickup_latitude"=> "$lat_from",
            "pickup_longitude"=> " $longi_from",
            "drop_off_latitude"=> "$lat_to",
            "drop_off_longitude"=> "$longi_to",
            "package_type"=> "SMALL",
            "trip_type"=> "EXPRESS",
            "channel"=> "MOBILE"
        ];

        $estimates = json_encode($estimate);
        $estimate_result = json_decode(curl($estimate));
        //dd($estimate_result);
        $est_cost = $estimate_result->estimateCost;
        

        $data = [
            "username"=> "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "OTPVAL",
            "phone_number" => "$phone",
            "otp" => "$otp",
            "channel" => "WEB"
        ];

        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);

        if ($result->responseCode == '000') {
            flash()->info('Success, Great successfully found');
            return view('landing.confirm', compact('result', 'longi_from','est_cost', 'longi_to', 'lat_to', 'lat_from', 'trip_type', 'voucher'));
        } else {
            flash()->error('Wrong OTP Provided');
        }
    }
    public function trackPackage(Request $request)
    {
        $trip_id = $request->input('trip_id');
        $this->validate($request, [
            'trip_id' => 'required',
        ]);
        $data = [

            "username" => "courier",
            "password" => "CoUrier2021",
            "processingCode" => "RDRCURLOC",
            "trip_id" => "$trip_id",
            "channel" => "PORTAL"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if ($result->responseCode == '000') {
            flash()->info('Success, Package successfully found');
            return view('landing.package', compact('result'));
        } else {
            flash()->error('Some error occured! Error');
            return view('landing.package_not', compact('result'));
        }
    }
public function confirmedTrip(Request $request)
    {
        $trip_id = $request->input('trip_id');

        $data = [
            "username" => "courier",
            "password" => "CoUrier2021",
            "processingCode" => "TRIPDET",
            "trip_id" => "$trip_id",
            "channel" => "ANDROID"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));
        // dd($result);
        if($result->responseCode == 000){
            return view('landing.confirmed', compact('result'));
        }
        flash()->error('Ooops...Something happened');
        // return view('landing.confirm');
    }
    public function tripDetails(Request $request)
    {
        $data = $request->all();
    }
    public function confirmTrip(Request $request)
    {
        $my_trip = $request->all();
        // dd($my_trip);
        $pickup_latitude = $request->get('pickup_latitude');
        $pickup_longitude = $request->get('pickup_longitude');
        $dropoff_longitude = $request->get('dropoff_longitude');
        $package_type = $request->get('package_type');
        $dropoff_latitude = $request->get('dropoff_latitude');
        $client_email = $request->get('email');
        // dd($client_email);
        $parcel_value = $request->get('parcel_value');
        $parcel_description = $request->get('parcel_description');
        $delivery_date = date("d-m-Y", strtotime($request->get('delivery_date')));
        // dd($delivery_date);
        $receiver_name = $request->get('receiver_name');
        $receiver_phone = $request->get('receiver_phone');
        $trip_type = $request->get('trip_type');
        $delivery_time = $request->get('delivery_time');
        // dd($delivery_time);

        $standard_time = $delivery_date. ' '.$delivery_time.":00";
        //  dd($standard_time);

        $payment_type = $request->get('payment_type');
        $billing_account = $request->get('billing_account');
        $delivery = $delivery_date . " " . $delivery_time;
        $corp_id =  $request->get('billing_account');
        $voucher_code = $request->get('voucher_code');
        $payment_by = $request->input('payment_by');

        if($billing_account !=='INDIVIDUAL'){
            $billing_account = "CORPORATE";
        }else{
            $billing_account = "INDIVIDUAL";
        }

        if($billing_account ==='CORPORATE'){
            $payment_type = "";
        }else{
            $billing_account;
        }


        $data = [
            "username" => "courier",
            "password" => "CoUrier2021",
            "processingCode" => "REQTRIP",
            "pickup_latitude" => $pickup_latitude,
            "pickup_longitude" => $pickup_longitude,
            "drop_off_latitude" => $dropoff_latitude,
            "drop_off_longitude" =>  $dropoff_longitude,
            "package_type" => "$package_type",
            "trip_type" => "$trip_type",
            "client_email" => "$client_email",
            "parcel_value" => "",
            "package_description" => "$parcel_description",
            "delivery_date" => $standard_time,
            "receiver_name" => "$receiver_name",
            "receiver_phone" => "$receiver_phone",
            "payment_by"=> "$payment_by",
            "corporate_id" => "$corp_id",
            "promotion_code" => "$voucher_code",
            "channel" => "WEB"
        ];
        $post = json_encode($data);
        // dd($post);
        $result = json_decode(curl($data));
        // dd($result);
        if ($result->responseCode === '000') {
            return view('landing.trip_details', compact('result'));
        } elseif($result->responseCode === '111') {
            flash()->error('Ooops, something happened');
            return view('landing.no_riders', compact('result'));
        } else{
            flash()->error('Ooops, something happened');
            return view('landing.trip_unsuccessful', compact('result'));
        }
    }
}
