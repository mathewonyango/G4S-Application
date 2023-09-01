<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public  function  getFormBalance(){
        return view('payments.add');
    }
}
