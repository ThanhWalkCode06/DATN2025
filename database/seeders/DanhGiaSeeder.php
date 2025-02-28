<?php

namespace Database\Seeders;

use App\Models\DanhGia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DanhGia::factory()->count(50)->create();
    }
}
