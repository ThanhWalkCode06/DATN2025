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
        DanhMucSanPham::factory()->count(10)->create();
    }
}
