<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BankController;
use App\Http\Controllers\Backend\WalletController;
use App\Http\Controllers\Backend\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('backend/login');
});

Route::prefix(config('app.admin_prefix'))->group(function ()
{
    Auth::routes([
      'register' => false, // Registration Routes...
      'reset' => false, // Password Reset Routes...
    ]);

    Route::middleware(['auth'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('banks', BankController::class);

        Route::resource('wallets', WalletController::class);

        Route::resource('transactions', TransactionController::class);

        Route::get('exchange-transactions/create', [TransactionController::class, 'exchangeCreate'])->name('exchange-transactions.create');
        Route::get('exchange-transactions', [TransactionController::class, 'exchangeIndex'])->name('exchange-transactions.index');

    });
});