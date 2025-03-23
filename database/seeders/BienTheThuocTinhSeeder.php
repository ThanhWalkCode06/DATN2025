<?php

namespace Database\Seeders;

use App\Models\BienTheThuocTinh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BienTheThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $rand = rand(1, 2);

            if ($rand == 1) {
                BienTheThuocTinh::create([
                    'bien_the_id' => $i,
                    'thuoc_tinh_id' => 1,
                    'gia_tri_thuoc_tinh_id' => rand(1, 5),
                ]);
            } else {
                BienTheThuocTinh::create([
                    'bien_the_id' => $i,
                    'thuoc_tinh_id' => 2,
                    'gia_tri_thuoc_tinh_id' => rand(6, 8),
                ]);
            }
        }
    }
}
