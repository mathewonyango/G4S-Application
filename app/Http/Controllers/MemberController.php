<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MemberController extends Controller
{
        public function search(Request $request){
            $number = $request->get('phone');
            $user =  DB::table('member')
                    ->where('phonenumber', '=', $number)
                    ->get();
            $result = json_decode($user);


            if (count($result)) {
                flash()->info('Success, user found');
                return view('groups.user', compact('user'));
        }

            flash()->error('User not found. Check the phone number');
            return redirect()->route('group.view-change');

        }

    public function pinresets(Request $request){
        $user =  DB::table('member')
                    ->where('maker', '=', 1)
                    ->get();
            $result = json_decode($user);


            return view('member.pinresets', compact('result'));
    }

    public function changepinUser(Request $request){
        $phonenumber =  $request->get('phone');
        // dd($phonenumber);
        $affected =  Member::where('phonenumber','=',$phonenumber)->update(['maker' => 1]);
        flash()->info('Successful. Will be approved by Checker');
        return redirect()->route('group.view-change');


    }

}
