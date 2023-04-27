<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'active'];

    protected $casts = [
        'type' => TransactionType::class
    ];
}
