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
        'type' => TransactionType::class
    ];
}
