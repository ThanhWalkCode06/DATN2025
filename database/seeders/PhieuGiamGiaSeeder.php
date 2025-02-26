<?php

namespace Database\Seeders;

use App\Models\PhieuGiamGia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhieuGiamGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhieuGiamGia::factory()->count(20)->create();
    }
}
