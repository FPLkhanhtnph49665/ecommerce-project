<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
        [
            'category_id' => 1, // Quần Ất Dậu
            'name' => 'Quần Jean Ất Dậu Wash Bụi',
            'slug' => Str::slug('Quần Jean Ất Dậu Wash Bụi'),
            'price' => 450000,
            'sale_price' => 390000,
            'stock' => 20,
            'image' => 'products/quan_jean_atdau.jpg',
            'description' => 'Quần jean phong cách bụi bặm, chất vải dày dặn, form chuẩn.',
        ],
        [
            'category_id' => 1,
            'name' => 'Quần Tây Ất Dậu Slimfit',
            'slug' => Str::slug('Quần Tây Ất Dậu Slimfit'),
            'price' => 500000,
            'sale_price' => 450000,
            'stock' => 15,
            'image' => 'products/quan_tay_atdau.jpg',
            'description' => 'Quần tây form slimfit lịch lãm, phù hợp đi làm và sự kiện.',
        ],
        [
            'category_id' => 2, // Quần Jean
            'name' => 'Quần Jean Nam Basic Xanh Đậm',
            'slug' => Str::slug('Quần Jean Nam Basic Xanh Đậm'),
            'price' => 400000,
            'sale_price' => 350000,
            'stock' => 25,
            'image' => 'products/quan_jean_basic.jpg',
            'description' => 'Quần jean basic dễ phối đồ, phù hợp mọi phong cách.',
        ],
        [
            'category_id' => 2,
            'name' => 'Quần Jean Rách Gối Streetwear',
            'slug' => Str::slug('Quần Jean Rách Gối Streetwear'),
            'price' => 480000,
            'sale_price' => 420000,
            'stock' => 18,
            'image' => 'products/quan_jean_rach.jpg',
            'description' => 'Phong cách streetwear cá tính, trẻ trung.',
        ],
        [
            'category_id' => 3, // Quần Tây
            'name' => 'Quần Tây Công Sở Cao Cấp',
            'slug' => Str::slug('Quần Tây Công Sở Cao Cấp'),
            'price' => 550000,
            'sale_price' => 500000,
            'stock' => 12,
            'image' => 'products/quan_tay_congso.jpg',
            'description' => 'Chất liệu cao cấp, thoải mái, không nhăn.',
        ],
        [
            'category_id' => 3,
            'name' => 'Quần Tây Ống Suông Hàn Quốc',
            'slug' => Str::slug('Quần Tây Ống Suông Hàn Quốc'),
            'price' => 520000,
            'sale_price' => 480000,
            'stock' => 10,
            'image' => 'products/quan_tay_hanquoc.jpg',
            'description' => 'Phong cách Hàn Quốc, form rộng hiện đại.',
        ],
        [
            'category_id' => 4, // Quần Short
            'name' => 'Quần Short Thun Nam Thể Thao',
            'slug' => Str::slug('Quần Short Thun Nam Thể Thao'),
            'price' => 200000,
            'sale_price' => 150000,
            'stock' => 30,
            'image' => 'products/quan_short_thethao.jpg',
            'description' => 'Co giãn tốt, phù hợp tập gym, chạy bộ.',
        ],
        [
            'category_id' => 4,
            'name' => 'Quần Short Kaki Dạo Phố',
            'slug' => Str::slug('Quần Short Kaki Dạo Phố'),
            'price' => 280000,
            'sale_price' => 240000,
            'stock' => 22,
            'image' => 'products/quan_short_kaki.jpg',
            'description' => 'Phong cách năng động, trẻ trung.',
        ],
        [
            'category_id' => 5, // Quần Thể Thao
            'name' => 'Quần Jogger Nam Thể Thao',
            'slug' => Str::slug('Quần Jogger Nam Thể Thao'),
            'price' => 350000,
            'sale_price' => 300000,
            'stock' => 18,
            'image' => 'products/jogger.jpg',
            'description' => 'Thiết kế bo ống, phù hợp vận động.',
        ],
        [
            'category_id' => 5,
            'name' => 'Quần Track Pants Sọc',
            'slug' => Str::slug('Quần Track Pants Sọc'),
            'price' => 320000,
            'sale_price' => 280000,
            'stock' => 20,
            'image' => 'products/trackpants.jpg',
            'description' => 'Phong cách thể thao hiện đại, thoải mái.',
        ],
    ];

    foreach ($products as $product) {
        Product::create($product);
    }
    }
}
