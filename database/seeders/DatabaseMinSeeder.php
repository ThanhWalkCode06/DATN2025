<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseMinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            AddPermissionAndRoleSeeder::class,
            AdminSeeder::class,
            AltUserSeeder::class,
            DanhMucSanPhamSeeder::class,
            PhuongThucThanhToanSeeder::class,
            ThuocTinhSeeder::class,
            GiaTriThuocTinhSeeder::class,
            DanhMucBaiVietSeeder::class,
        ]);
    }
}
