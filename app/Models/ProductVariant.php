<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color',
        'size',
        'price',
        'sale_price',
        'stock',
        'sku',
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Giá thực tế (ưu tiên sale)
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }
    protected static function booted()
    {
        static::saved(function ($variant) {
            $variant->product->updateStock();
        });

        static::deleted(function ($variant) {
            $variant->product->updateStock();
        });

         static::creating(function ($variant) {
        if (!$variant->sku) {
            // Lấy chữ cái đầu của color, in hoa
            $colorAbbr = strtoupper(substr($variant->color, 0, 1));
            // Lấy size in hoa
            $sizeAbbr = strtoupper($variant->size);
            // SKU: P{product_id}-{color}-{size}
            $variant->sku = "P{$variant->product_id}-{$colorAbbr}-{$sizeAbbr}";
        }
    });
    }
}
