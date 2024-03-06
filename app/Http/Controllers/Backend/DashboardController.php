<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Enums\TransactionType;

class DashboardController extends Controller
{
    public function index()
    {
        $wallets = Wallet::with('transaction')->get();
        $balance = Wallet::sum('balance');
        // $expense = Transaction::where('type',TransactionType::EXPENSE)->sum('amount');
        // $income = Transaction::where('type',TransactionType::INCOME)->sum('amount');
// 
        return view('dashboard',compact('wallets','balance'));
    }
}
