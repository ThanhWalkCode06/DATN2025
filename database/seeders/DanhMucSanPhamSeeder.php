<?php

namespace Database\Seeders;

use App\Models\DanhMucSanPham;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhMucSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = ['Áo', 'Quần', 'Giày', 'Mũ','Áo Hoodio','Thời Trang','Thể thao'];
        foreach ($name as $key => $value) {
            DanhMucSanPham::create([
                'ten_danh_muc' => $value,
                'mo_ta' => 'Consequatur et et omnis natus dolore est autem a. Cumque quibusdam consequatur ullam aut impedit.'
            ]);
        }
    }
}
