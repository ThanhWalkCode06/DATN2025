<?php

namespace Database\Seeders;

use App\Models\DonHang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DonHang::factory()->count(50)->create();
    }
}
