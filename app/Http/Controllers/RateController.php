<?php

namespace App\Http\Controllers;
use App\Rate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RateController extends Controller
{
    public function create(){
        return view('rates.create');
    }
    public  function postRates(Request $request){
        $validated = $request->validate([
            'price_rate' => 'required',
            'package_type' => 'required'
        ]);
        $rate = $request->get('price_rate');
        $package_type = $request->get('package_type');

        $query = DB::table('package_and_rates')->insert([
            'price_rate' => $rate,
            'package_type'=> $package_type,
            'currency'=> 'KES',
            'created_at'=> Carbon::now(),
        ]);
        if($query){
            flash()->info('The FAQ added successfully. ');
            return redirect()->route('rate.list');
        }
        else{
            flash()->error('Some error occured! Look at your data ');
            return redirect()->route('rate.list');

        }

    }
    public function index(){
        $rates = DB::table('package_and_rates')->get();
        // dd($rates);
        return view('rates.index', compact('rates'));
        }
    public function edit($id){
        $rates = Rate::find($id);
        return view('rates.edit', compact('rates'));
    }
    public  function update(Request $request, $id){
        $package_type = $request->get('package_type');
        $price_rate = $request->get('price_rate');

        $rate= Rate::find($id);
        $new_update = DB::table('package_and_rates')
            ->where('id', $id)
            ->update([
//                'package_type' => $package_type,
                'price_rate' => $price_rate,
            ]);
        flash()->info('Rate update done successful');
        return redirect()->route('rate.list');
        }

    public  function remove($id){
        $rate= Rate::find($id);
        Rate::destroy($id);
        flash()->info('The pricing and rate has been successfully removed from the system');
        return redirect()->route('rate.list');
    }
}
