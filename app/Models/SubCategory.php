<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'category_id', 'name', 'type', 'active'];

    protected $casts = [
        'type' => TransactionType::class
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
