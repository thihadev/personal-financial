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
        $wallets = Wallet::get();
        $balance = Wallet::sum('balance');
        $expense = Transaction::where('type',TransactionType::PAY)->sum('amount');

        return view('dashboard',compact('wallets','balance','expense'));
    }
}
