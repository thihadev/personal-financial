<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Wallet;
use App\Http\Requests\BorrowRequest;
use Illuminate\Http\Request;
use App\Enums\TransactionType;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::whereIn('type', [TransactionType::BORROW, TransactionType::LEND])->paginate();
        $wallets = Wallet::get();
        $total_borrow = $transactions->where('type', TransactionType::BORROW)->sum('amount');
        $total_lend = $transactions->where('type', TransactionType::LEND)->sum('amount');
        $residual_amount = ($total_borrow + $total_lend);

        $span = $residual_amount < 0 ? 'text-green' : 'text-red'; 

        return view('backend.borrows.index', compact('transactions','wallets','total_borrow','total_lend','span','residual_amount'));
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

        return view('backend.borrows.create',compact('categories','wallets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BorrowRequest $request)
    {
        $data = $request->validated();

        $data['amount'] = TransactionType::BORROW->value == $data['type'] ? $data['amount'] : -$data['amount'];
        $data['user'] = isset($data['from_user']) ? $data['from_user'] : $data['to_user'];

        Transaction::create($data);

        return redirect()->route('borrows.index')->with('flash','Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $borrow)
    {
        $title = ($borrow->type == TransactionType::BORROW) ? "BORROW: You ➜ {$borrow->user}" : "LEND: {$borrow->user} ➜ You";

        return view('backend.borrows.show', compact('borrow', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $borrow)
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
    public function update(Request $request, Transaction $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $borrow)
    {
        //
    }

    public function payback(PaybackRequest $request)
    {
        // code...
    }
}
