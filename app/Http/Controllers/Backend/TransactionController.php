<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Enums\TransactionType;
use App\Filters\TransactionFilter;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionFilter $filter)
    {
        $transactions = Transaction::orderBy('date','desc')->whereIn('type',[TransactionType::INCOME, TransactionType::EXPENSE])->filter($filter)->paginate(20);

        $wallets = Wallet::get();
        $total = $transactions->sum('transaction_amount');
        $span = $total > 0 ? 'text-green' : 'text-red';

        return view('backend.transactions.index', compact('transactions','wallets','total', 'span'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $wallets = Wallet::get();

        return view('backend.transactions.create',compact('categories','wallets'));
    }

    public function exchangeIndex(TransactionFilter $filter)
    {
        $transactions = Transaction::orderBy('date','desc')->filter($filter)->paginate(20);

        $wallets = Wallet::get();

        return view('backend.exchanges.index', compact('transactions','wallets'));
    }

    public function exchangeCreate()
    {
        $categories = Category::get();
        $wallets = Wallet::get();

        return view('backend.exchanges.create',compact('categories','wallets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->validated();

        $data['type'] = Category::find($data['category_id'])->type;

        Transaction::create($data);

        if ($request->transfer_wallet_id) {
            return redirect()->route('exchange-transactions.index')->with('success', 'Successfully credated.');
        }

        return redirect()->route('transactions.index')->with('success', 'Successfully credated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {

        $transaction->wallet->balance -= $transaction->transaction_amount;
        $transaction->wallet->update();

        $transaction->delete();

        return redirect()->route('transactions.index')->with('flash','Successfully deleted.');
    }
}
