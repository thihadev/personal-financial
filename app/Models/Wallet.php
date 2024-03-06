<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_name',
        'initial_amount',
        'balance',
        'note',
        'active',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function lastBalance()
    {
        return $this->initial_amount + $this->balance;
    }

    public function lastBalanceDate()
    {
        return $this->updated_at->format('d/m/Y H:iA');
    }

}
