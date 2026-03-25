<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'sale_price',
        'stock',
        'image',
        'description',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    // 🔥 AUTO SUM STOCK
    public function updateStock()
    {
        $this->stock = $this->variants()->sum('stock');
        $this->saveQuietly(); // tránh loop
    }

    // 👉 Lấy stock realtime (không cần DB)
    public function getTotalStockAttribute()
    {
        return $this->variants->sum('stock');
    }
}
