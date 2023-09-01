<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MPESAController extends Controller
{
    public function getUrlSecure(Request $request){
        //get requests and send to backend
     $data_seen = 'Today is Thursday';
        //in json format
      print_r($data_seen);
    }
}
