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
        "user",
        "category_id",
        "sub_category_id",
        "type",
        "amount",
        "date",
        "last_balance",
        "description",
        "fees",
        'status'
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
            if (($transaction->type == TransactionType::EXPENSE) || ($transaction->type == TransactionType::LEND)) {
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance -= ($transaction->amount + $transaction->fees);
                $wallet->update();
            } elseif (($transaction->type == TransactionType::INCOME) || ($transaction->type == TransactionType::BORROW)) {
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance += ($transaction->amount + $transaction->fees);
                $wallet->update();
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

    public function history()
    {
        return $this->hasMany(TransactionHistory::class,'transaction_id','id');
    }

    public function color() 
    {
        $type = match ($this->type) {
            TransactionType::EXPENSE => 'danger',
            TransactionType::INCOME => 'success',
            TransactionType::LEND => 'success',
            TransactionType::BORROW => 'danger',
            TransactionType::CREDIT => 'primary',
            default     => 'info'    
        };

        return $type;
    }
}
