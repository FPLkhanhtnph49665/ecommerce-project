<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Đây Rồi',
                'password' => Hash::make('1'),
                'role' => 'admin',
            ]
        );

        // CUSTOMER
        User::updateOrCreate(
            ['email' => '1@gmail.com'],
            [
                'name' => 'Ất Dậu',
                'password' => Hash::make('1'),
                'role' => 'customer',
            ]
        );
    }
}
