<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\WalletRequest;
use App\Models\Bank;
use App\Models\Transaction;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = Wallet::latest()->paginate(20);

        return view('backend.wallets.index',compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::latest()->get();

        return view('backend.wallets.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletRequest $request)
    {
        $data = $request->validated();

        $data['balance'] = $request->initial_amount;
        $data['user_id'] = auth()->id();

        Wallet::create($data);
        // $payments = Bank::get();

        // for ($i=0; $i < $payments->count(); $i++) {
        //     $wallet = new Wallet();
        //     $wallet->user_id = $request->user_id;
        //     $wallet->bank_id = $payments[$i]->id;
        //     $wallet->balance = 0;
        //     $wallet->save();
        // }

        return redirect()->route('wallets.index')->with('success', 'Successfully credated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        return view('backend.wallets.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(WalletRequest $request, Wallet $wallet)
    {
        $data = $request->validated();

        $transaction_amount = Transaction::where('wallet_id',$wallet->id)->sum('amount');
        
        $wallet->update([
            'initial_amount' => $data['initial_amount'],
            'balance' => $data['initial_amount'] - $transaction_amount,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
