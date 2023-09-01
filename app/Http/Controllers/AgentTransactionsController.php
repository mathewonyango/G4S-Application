<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceInquiryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AgentTransactionsController extends Controller
{
    public function fetchBalance()
    {
        abort_if(Gate::denies('inquire_balance'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        trail('Balance Inquiry', 'Balance inquiry form');
        return view('agent-transactions.balance-inquiry');
    }

    public function balance(BalanceInquiryRequest $request)
    {
        $customer_number = $request->validated();
        trail('Fetch Balance', 'send balance request');

        return back();
    }


    public function cashDeposit()
    {
        abort_if(Gate::denies('make_deposits'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        trail('Make Deposit', 'make customers deposit');
        return view('agent-transactions.deposit');
    }

    public function cashWithdrawal()
    {
        abort_if(Gate::denies('make_withdrawal'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('agent-transactions.withdraw');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
