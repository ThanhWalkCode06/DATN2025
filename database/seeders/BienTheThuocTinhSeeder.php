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
        $insertData = [];

        for ($i = 1; $i <= 1000; $i++) {
            $rand = rand(1, 2);

            $insertData[] = [
                'bien_the_id' => $i,
                'thuoc_tinh_id' => $rand == 1 ? 1 : 2,
                'gia_tri_thuoc_tinh_id' => $rand == 1 ? rand(1, 5) : rand(6, 8),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chèn dữ liệu một lần
        BienTheThuocTinh::insert($insertData);
    }
}
