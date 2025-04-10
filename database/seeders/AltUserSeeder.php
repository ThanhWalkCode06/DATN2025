<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AltUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $username = 'user' . $i;
            $email = 'user' . $i . '@gmail.com';
            $tenNguoiDung = 'User ' . $i;

            User::create([
                'username' => $username,
                'email' => $email,
                'password' => Hash::make('123456'),
                'ten_nguoi_dung' => $tenNguoiDung,
                'so_dien_thoai' => '098765432' . $i + 1,
            ]);
        }
    }
}
