<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Models\Category;
use App\Models\Wallet;
use App\Http\Requests\BorrowRequest;
use App\Http\Requests\PaybackRequest;
use Illuminate\Http\Request;
use App\Enums\TransactionType;
use Illuminate\Support\Facades\DB;

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
        $lend = Transaction::where('status', 0)->where('type', TransactionType::LEND)
        ->selectRaw('SUM(amount - payback_amount) as total_payback, SUM(amount) as total_lend')->first();

        $total_borrow = Transaction::where('status', 0)->where('type', TransactionType::BORROW)->sum(DB::raw('amount - payback_amount'));

        $residual_amount = ($total_borrow - $lend->total_payback);

        $span = $residual_amount < 0 ? 'text-green' : 'text-red'; 

        return view('backend.borrows.index', compact('transactions','wallets','total_borrow','lend','span','residual_amount'));
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

        $data['user'] = isset($data['from_user']) ? $data['from_user'] : $data['to_user'];
        $data['status'] = 0;

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
        $wallets = Wallet::get();

        return view('backend.borrows.show', compact('borrow', 'title','wallets'));
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
        $data = $request->validated();

        if ($request->type == 3) {
            $data['type'] = TransactionType::INCOME->value;
            $data['amount'] = $data['amount'];
        }else{
            $data['type'] = TransactionType::EXPENSE->value;
            $data['amount'] = -$data['amount'];
        }
        
        $data['category_id'] = 1;
        $transaction = Transaction::create($data);

        $history = TransactionHistory::create($data);

        $history_tran = $history->transaction;
        $history_tran->payback_amount += $data['amount'];

        if (abs($history_tran->amount) <= abs($history->sum('amount'))) {
            $history_tran->update([
                'status' => 1
            ]);
        }

        return redirect()->back();
    }
}
