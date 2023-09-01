<?php

namespace App\Http\Controllers;

use App\Promos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosController extends Controller
{
    public function createPromo()
    {
        return view('promos.create');
    }
    public function createPromoSequential()
    {
        return view('promos.sequential');
    }

    public function verifyPromo()
    {
        return view('promos.validate');
    }

    public function viewPromos()
    {
        $all_promos = DB::table('promotions')->orderBy('id', 'DESC')->get();
        // dd($all_promos);
        return view('promos.available', compact('all_promos'));
    }

    public function generatePromoSequential(Request $request)
    {
        $name = $request->get('name');
        $applies_to = $request->get('applies_to');
        $amount = $request->get('amount');
        $expiry = $request->get('expiry');
        $start_date = $request->get('start_date');

        $validated = $request->validate([
            'name' => 'required',
            'applies_to' => 'required',
            'amount' => 'required',
            'expiry' => 'required',
            'start_date' => 'required'

        ]);
        $promo_code = new Promos([
            'name'=>$name,
            'promo_code' =>$name,
            'amount' =>$amount ,
            'applies_to' =>$applies_to ,
            'applicable_times' =>1 ,
            'status' =>1,
            'expiry' =>$expiry,
            'start_date' =>$start_date,

        ]);
        $promo_code->save();
        flash()->info('Promo Code generated successfully');
        return redirect()->route('promo.retrieve-promo');
    }

    public function generatePromo(Request $request)
    {
        $name = $request->get('name');
        $applies_to = $request->get('applies_to');
        $amount = $request->get('amount');
        $expiry = $request->get('expiry');
        $start_date = $request->get('start_date');
        $code = mt_rand(999, 1952);

        $validated = $request->validate([
            'name' => 'required',
            'applies_to' => 'required',
            'amount' => 'required',
            'expiry' => 'required',
            'start_date' => 'required'

        ]);
        $n = 28;//expiry
        $result = bin2hex(random_bytes($n));
        $to_use = substr($result, 20, 17);
        $final_promo = mb_substr($to_use, 0, 7);
        $promo_code = new Promos([
            'name'=>$name,
            'promo_code' =>strtoupper($final_promo) ,
            'amount' =>$amount ,
            'applies_to' =>$applies_to ,
            'applicable_times' =>1 ,
            'status' =>1,
            'expiry' =>$expiry,
            'start_date' =>$start_date,

        ]);
        $promo_code->save();
        flash()->info('Promo Code generated successfully');
        return redirect()->route('promo.retrieve-promo');
    }

}
