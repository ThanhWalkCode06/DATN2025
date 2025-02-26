<?php

namespace Database\Seeders;

use App\Models\PhuongThucThanhToan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhuongThucThanhToanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhuongThucThanhToan::factory()->count(5)->create();
    }
}
