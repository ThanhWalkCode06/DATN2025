<?php

namespace Database\Seeders;

use App\Models\BaiViet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BaiViet::factory()->count(20)->create();
    }
}
