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

            foreach ($colors as $color) {
                foreach ($sizes as $size) {

                    $basePrice = $product->sale_price ?? $product->price;

                    ProductVariant::create([
                        'product_id' => $product->id,

                        'color' => $color,
                        'size' => $size,

                        'sku' => 'P' . $product->id . '-' . $size . '-' . Str::upper(Str::ascii($color)),

                        'price' => $basePrice + rand(0, 20000),
                        'sale_price' => null,

                        'stock' => rand(1, 30),
                    ]);
                }
            }
        }
    }
}
