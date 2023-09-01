<?php

namespace App\Http\Controllers;

use App\Limits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LimitsController extends Controller
{
    public function customers(){
        return view('limits.customer');

    }
    public function create(){
        $maker = Auth::user()->id;

        return view('limits.create', compact('maker'));
    }

    public function limits(){
        // $limits = Limits::all();
        $limits = DB::table('Limit')->get();
        return view('limits.index', compact('limits'));

    }

    public function edit(Limits $limit)
    {

        trail('Edit Limits', 'Initiate limit edit');

        return view('limits.edit', compact('limit','roles'));
    }

    public function update(Request $request, limits $limit)
    {

        $this->validate($request, [
            'DailyLimit' => 'required',
            'ProcessingCode',
            'TransactionLimit' => 'required',
        ]);

        trail('Update limits', 'Limit update');

        $limit->update([
            'TransactionLimit' => $request->get('TransactionLimit'),
            'ProcessingCode' => $request->get('ProcessingCode'),
            'DailyLimit' => $request->get('DailyLimit'),

        ]);

        flash('Limits updated successfully')->important();
        return redirect()->route('limits.limits');
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'maker'=>'required',
            'DailyLimit' => 'required',
            'ProcessingCode',
            'TransactionLimit' => 'required',
        ]);

        trail('Add limits', 'Limit addition');

        $limit = new Limits;

        $limit->DailyLimit = request('DailyLimit');
        $limit->ProcessingCode = request('ProcessingCode');
        $limit->TransactionLimit = request('TransactionLimit');
        $limit->maker = request('maker');
        $limit->save();

        flash('Limits added successfully')->important();
        return redirect()->route('limits.limits');
    }
}
