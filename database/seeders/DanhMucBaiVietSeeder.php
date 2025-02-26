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
        DanhMucBaiViet::factory()->count(10)->create();
    }
}
