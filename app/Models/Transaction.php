<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "wallet_id",
        "transfer_wallet_id",
        "user_id",
        "category_id",
        "type",
        "amount",
        "date",
        "last_balance",
        "description",
    ];


    protected $casts = [
        'type' => TransactionType::class,
        'date' => 'datetime:Y-m-d',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function($transaction)
        {
            if ($transaction->type == TransactionType::PAY) {
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance -= ($transaction->amount + $transaction->fees);
                $wallet->update();
            } elseif ($transaction->type == TransactionType::RECEIVED) {
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance += ($transaction->amount + $transaction->fees);
                $wallet->update();
            } elseif ($transaction->type == TransactionType::EXCHANGE){
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance -= ($transaction->amount + $transaction->fees);
                $wallet->update();

                $transfer_wallet = Wallet::find($transaction->transfer_wallet_id);
                $transfer_wallet->balance += ($transaction->amount);
                $transfer_wallet->update();
            }
            
        });       
    }


    /* query scopes */
    public function scopeFilter($query, $filter)
    {
        $filter->apply($query);
    }
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }    

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }    

    public function transferWallet()
    {
        return $this->belongsTo(Wallet::class,'transfer_wallet_id','id');
    }

    public function color() 
    {
        $type = match ($this->type) {
            TransactionType::PAY => 'danger',
            TransactionType::RECEIVED => 'success',
            TransactionType::EXCHANGE => 'warning',
            default     => 'info'    
        };

        return $type;
    }
}
