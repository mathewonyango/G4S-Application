<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NotificationsController extends Controller
{
    public  function create(){
        return view('notifications.create-sms');
    }
    public  function sentSMS(){
        return view('notifications.sms');
    }
    public  function createPush(){
        return view('notifications.push');
    }
    public function sendPush(Request $request){
        $title = $request->input('title');
        $message = $request->input('message');
        $category= $request->input('category');

        try {
            $this->validate($request, [
                'title' => 'required',
                'message' => 'required',
                'category' => 'required',
            ]);
        } catch (ValidationException $e) {
        }

        $data = [
            "username" => "courier",
            "password"=>"CoUrier2021",
            "processingCode"=> "BULK_PUSH",
            "title"=>"$title",
            "body" =>"$message",
            "target" => "$category",
            "channel" => "ANDROID"
        ];

        $post = json_encode($data);
        $result = json_decode(curl($data));
        if($result->responseCode == '000'){
            flash()->success('Push notification sent successfully');
            return view('notifications.push');
        }
        else{
            flash()->error('Oops. Try again');
            return view('notifications.push');

        }

    }
    public function sendSMS(Request $request){
        $message = $request->input('message');
        $category= $request->input('category');

        try {
            $this->validate($request, [
                 'message' => 'required',
                'category' => 'required',
            ]);
        } catch (ValidationException $e) {
        }
        $data = [
           "username" => "courier",
            "password"=> "CoUrier2021",
            "processingCode"=> "BULK_SMS",
            "body" => "$message",
            "target" => "$category",
            "channel" => "ANDROID"
        ];
        $post = json_encode($data); 
        $result = json_decode(curl($data));
        if($result->responseCode == '000'){
            flash()->info('SMS sent successfully.');
            return view('notifications.sms');
        }
        flash()->error('SMS NOT Sent. Something bad happened. Try again' );
        return view('notifications.create-sms');

    }
    public function RetrieveSMS(){
        $all_sms = DB::table();
    }
}

