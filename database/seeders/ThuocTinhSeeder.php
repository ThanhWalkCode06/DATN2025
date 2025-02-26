<?php

namespace Database\Seeders;

use App\Models\ThuocTinh;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThuocTinh::factory()->count(5)->create();
    }
}
