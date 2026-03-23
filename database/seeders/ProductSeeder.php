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
                'category_id' => 1,
                'name' => 'Bàn gỗ tự nhiên',
                'slug' => Str::slug('Bàn gỗ tự nhiên'),
                'price' => 1500000,
                'sale_price' => 1200000,
                'stock' => 10,
                'image' => 'products/ban_go.jpg',
                'description' => 'Bàn gỗ tự nhiên cao cấp, chắc chắn, sang trọng.',
            ],
            [
                'category_id' => 1,
                'name' => 'Ghế sofa da',
                'slug' => Str::slug('Ghế sofa da'),
                'price' => 3500000,
                'sale_price' => 3000000,
                'stock' => 5,
                'image' => 'products/sofa_da.jpg',
                'description' => 'Ghế sofa bọc da thật, êm ái và bền bỉ.',
            ],
            [
                'category_id' => 2,
                'name' => 'Kệ tivi gỗ công nghiệp',
                'slug' => Str::slug('Kệ tivi gỗ công nghiệp'),
                'price' => 1200000,
                'sale_price' => 1000000,
                'stock' => 7,
                'image' => 'products/ke_tivi.jpg',
                'description' => 'Kệ tivi hiện đại, tiện nghi cho phòng khách.',
            ],
            [
                'category_id' => 2,
                'name' => 'Bàn học sinh',
                'slug' => Str::slug('Bàn học sinh'),
                'price' => 800000,
                'sale_price' => 700000,
                'stock' => 15,
                'image' => 'products/ban_hocsinh.jpg',
                'description' => 'Bàn học nhỏ gọn, phù hợp học sinh.',
            ],
            [
                'category_id' => 3,
                'name' => 'Ghế ăn gỗ',
                'slug' => Str::slug('Ghế ăn gỗ'),
                'price' => 450000,
                'sale_price' => 400000,
                'stock' => 20,
                'image' => 'products/ghe_an.jpg',
                'description' => 'Ghế ăn bằng gỗ, chắc chắn và đẹp mắt.',
            ],
            [
                'category_id' => 3,
                'name' => 'Tủ quần áo 2 cánh',
                'slug' => Str::slug('Tủ quần áo 2 cánh'),
                'price' => 2000000,
                'sale_price' => 1800000,
                'stock' => 6,
                'image' => 'products/tu_quanao.jpg',
                'description' => 'Tủ quần áo tiện dụng, gọn gàng.',
            ],
            [
                'category_id' => 1,
                'name' => 'Giường ngủ gỗ sồi',
                'slug' => Str::slug('Giường ngủ gỗ sồi'),
                'price' => 3500000,
                'sale_price' => 3200000,
                'stock' => 3,
                'image' => 'products/giuong_go.jpg',
                'description' => 'Giường ngủ chắc chắn, sang trọng.',
            ],
            [
                'category_id' => 4,
                'name' => 'Đèn bàn LED',
                'slug' => Str::slug('Đèn bàn LED'),
                'price' => 250000,
                'sale_price' => 200000,
                'stock' => 12,
                'image' => 'products/den_ban.jpg',
                'description' => 'Đèn bàn LED tiết kiệm điện, ánh sáng tốt.',
            ],
            [
                'category_id' => 4,
                'name' => 'Thảm trải sàn',
                'slug' => Str::slug('Thảm trải sàn'),
                'price' => 600000,
                'sale_price' => 500000,
                'stock' => 8,
                'image' => 'products/tham.jpg',
                'description' => 'Thảm trải sàn êm ái, chống trơn trượt.',
            ],
            [
                'category_id' => 2,
                'name' => 'Bàn trà kính',
                'slug' => Str::slug('Bàn trà kính'),
                'price' => 900000,
                'sale_price' => 800000,
                'stock' => 9,
                'image' => 'products/ban_tra.jpg',
                'description' => 'Bàn trà kính hiện đại cho phòng khách.',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
