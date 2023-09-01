<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbacksController extends Controller
{
 public function showRiderFeedback(){
     $feedbacks = DB::table('ratings')
                ->where('rated_by', '=', 'RIDER')
                ->orderBy('id', 'DESC')
                ->paginate(5);

     return view('riders.show-feedback', compact('feedbacks'));
 }
 public function showClientFeedback(){
     $feedbacks = DB::table('ratings')
                ->where('rated_by', '=', 'CLIENT')
                ->orderBy('id', 'DESC')
                ->paginate(5);
    return view('clients.show-feedback', compact('feedbacks'));
}


}
