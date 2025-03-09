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
        $name = ['Size','Color'];
        foreach ($name as $key => $value) {
            ThuocTinh::create([
                'ten_thuoc_tinh' => $value,
            ]);
        }
    }
}
