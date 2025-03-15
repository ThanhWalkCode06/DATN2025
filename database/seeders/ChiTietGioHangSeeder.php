<?php

namespace Database\Seeders;

use App\Models\ChiTietGioHang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChiTietGioHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChiTietGioHang::factory()->count(100)->create();
    }
}
