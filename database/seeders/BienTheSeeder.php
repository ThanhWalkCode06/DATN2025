<?php

namespace Database\Seeders;

use App\Models\BienThe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BienTheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BienThe::factory()->count(100)->create();
    }
}
