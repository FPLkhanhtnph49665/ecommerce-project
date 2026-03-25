<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Quần Jean Ất Dậu Wash Bụi',
                'slug' => Str::slug('Quần Jean Ất Dậu Wash Bụi'),
                'price' => 450000,
                'sale_price' => 390000,
                'stock' => 20,
                'image' => 'products/quan_jean_atdau.jpg',
                'description' => 'Quần jean phong cách bụi bặm, chất vải dày dặn, form chuẩn.',

                'variants' => [
                    ['color' => 'Xanh', 'size' => 'S', 'price' => 390000, 'stock' => 5],
                    ['color' => 'Đen', 'size' => 'M', 'price' => 390000, 'stock' => 10],
                    ['color' => 'Xanh', 'size' => 'L', 'price' => 390000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => 2,
                'name' => 'Quần Tây Ất Dậu Slimfit',
                'slug' => Str::slug('Quần Tây Ất Dậu Slimfit'),
                'price' => 500000,
                'sale_price' => 450000,
                'stock' => 15,
                'image' => 'products/quan_tay_atdau.jpg',
                'description' => 'Quần tây form slimfit lịch lãm, phù hợp đi làm và sự kiện.',

                'variants' => [
                    ['color' => 'Đen', 'size' => '29', 'price' => 40000, 'stock' => 5],
                    ['color' => 'Xanh', 'size' => '30', 'price' => 50000, 'stock' => 5],
                    ['color' => 'Đen', 'size' => '31', 'price' => 450000, 'stock' => 5],
                ],
            ],
        ];

        foreach ($products as $p) {

            $product = Product::create([
                'category_id' => $p['category_id'],
                'name' => $p['name'],
                'slug' => $p['slug'],
                'price' => $p['price'],
                'sale_price' => $p['sale_price'],
                'stock' => $p['stock'],
                'image' => $p['image'],
                'description' => $p['description'],
            ]);

            foreach ($p['variants'] as $index => $v) {

                ProductVariant::create([
                    'product_id' => $product->id,

                    'color' => $v['color'],
                    'size' => $v['size'],

                    'sku' => strtoupper(Str::slug($product->name))
                        . '-' . $v['size']
                        . '-' . strtoupper(substr($v['color'], 0, 2)),

                    'price' => $v['price'],
                    'sale_price' => null,

                    'stock' => $v['stock'],
                ]);
            }
        }
    }
}
