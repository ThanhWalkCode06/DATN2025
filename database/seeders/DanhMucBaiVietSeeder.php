<?php

namespace Database\Seeders;

use App\Models\DanhMucBaiViet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhMucBaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DanhMucBaiViet::firstOrCreate([
            'id' => 1,
            'ten_danh_muc' => 'Hỗ trợ',
            'mo_ta' => 'Hỗ trợ khách hàng'
        ]);
        DanhMucBaiViet::factory()->count(10)->create();
    }
}
