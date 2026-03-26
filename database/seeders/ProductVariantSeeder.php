<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $colors = ['Đỏ', 'Xanh', 'Vàng', 'Đen'];
        $sizes = ['S', 'M', 'L', 'XL'];

        $products = Product::all();

        foreach ($products as $product) {

            // Giá gốc
            $basePrice = $product->sale_price ?? $product->price;

            foreach ($colors as $color) {
                foreach ($sizes as $size) {

                    $sku = 'P' . $product->id
                        . '-' . $size
                        . '-' . strtoupper(substr(Str::slug($color), 0, 1));

                    $discountPercent = rand(15, 30);

                    $salePrice = $basePrice - ($basePrice * $discountPercent / 100);

                    ProductVariant::updateOrCreate(
                        [
                            'sku' => $sku
                        ],
                        [
                            'product_id' => $product->id,
                            'color' => $color,
                            'size' => $size,
                            'price' => $basePrice,
                            'sale_price' => round($salePrice), // 🔥 làm tròn
                            'stock' => rand(5, 20),
                        ]
                    );
                }
            }
        }
    }
}
