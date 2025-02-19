<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'thanhnguyen062004@gmail.com'], // Điều kiện kiểm tra bản ghi tồn tại
            [
                'name' => 'admin',
                'password' => Hash::make('123456'), // Mật khẩu nên mã hóa
            ]
        );
    }
}
