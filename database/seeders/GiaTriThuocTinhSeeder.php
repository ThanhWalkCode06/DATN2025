<?php

namespace Database\Seeders;

use App\Models\GiaTriThuocTinh;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GiaTriThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            0 => [
                [
                    'thuoc_tinh_id' => 1,
                    'gia_tri' => 'Đỏ',
                ],
                [
                    'thuoc_tinh_id' => 1,
                    'gia_tri' => 'Xanh',
                ],
                [
                    'thuoc_tinh_id' => 1,
                    'gia_tri' => 'Tím',
                ],
                [
                    'thuoc_tinh_id' => 2,
                    'gia_tri' => 'Đen',
                ],
                [
                    'thuoc_tinh_id' => 1,
                    'gia_tri' => 'Trắng',
                ],

            ],

            1 => [
                [
                    'thuoc_tinh_id' => 2,
                    'gia_tri' => 'M',
                ],
                [
                    'thuoc_tinh_id' => 2,
                    'gia_tri' => 'S',
                ],
                [
                    'thuoc_tinh_id' => 2,
                    'gia_tri' => 'L',
                ],
            ],
        ];

        foreach ($data as $index => $item) {
            foreach ($item as $i) {
                GiaTriThuocTinh::updateOrCreate($i);
            }
        }
    }
}
