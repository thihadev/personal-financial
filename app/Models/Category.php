<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'type', 'active'];

    protected $casts = [
        'type' => TransactionType::class
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($category)
        {
            $image = image_path($category->image);
            if ($image) {
                Storage::delete($image);
            }
        });       
    }
}
