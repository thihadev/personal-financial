<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable =  [
        'transaction_id',
        'amount',
        'type',
        'date',
    ];

        protected $casts = [
        'type' => TransactionType::class,
        'date' => 'datetime:Y-m-d',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
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
