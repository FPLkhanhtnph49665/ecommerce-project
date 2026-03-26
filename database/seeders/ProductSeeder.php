<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $names = [
            'Quần Jean Ất Dậu Wash Bụi',
            'Quần Tây Slimfit Công Sở',
            'Áo Thun Basic Cotton',
            'Áo Sơ Mi Trắng Hàn Quốc',
            'Áo Hoodie Streetwear',
            'Quần Short Thể Thao',
            'Áo Polo Cao Cấp',
            'Quần Kaki Nam',
            'Áo Khoác Bomber',
            'Áo Len Mùa Đông',
            'Quần Jogger',
            'Áo Tank Top Gym',
            'Áo Khoác Jeans',
            'Quần Tây Premium',
            'Áo Sơ Mi Denim',
        ];

        foreach ($names as $name) {

            $price = rand(250000, 700000);

            Product::create([
                'category_id' => rand(1, 3),
                'name' => $name,
                'slug' => Str::slug($name),
                'price' => $price,
                'sale_price' => $price - rand(20000, 80000),
                'stock' => 20,
                'image' => 'products/default.jpg',
                'description' => $name . ' chất lượng cao.',
            ]);
        }
    }
}
