<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;
use Illuminate\Support\Facades\Storage;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'category_id', 'name', 'type', 'active'];

    protected $casts = [
        'type' => TransactionType::class
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($sub_category)
        {
            $image = image_path($sub_category->image);
            if ($image) {
                Storage::delete($image);
            }
        });       
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
