<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    $fillable =  [
        'transaction_id',
        'amount',
        'type',
        'date',
    ];

    public function history()
    {
        return $this->belongsTo(Transaction::class);
    }  
}
