<?php

namespace Database\Seeders;

use App\Models\ChiTietDonHang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChiTietDonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChiTietDonHang::factory()->count(100)->create();
    }
}
