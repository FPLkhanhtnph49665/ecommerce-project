<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
{
    $categories = [
        'Quần Ất Dậu',
        'Quần Jean',
        'Quần Tây',
        'Quần Short',
        'Quần Thể Thao',
    ];

    foreach ($categories as $name) {
        Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }
}
}
