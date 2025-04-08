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
        $item = [
            ['ten_phuong_thuc' => 'Tiền mặt'],
            ['ten_phuong_thuc' => 'VNPAY'],
            ['ten_phuong_thuc' => 'Ví'],
        ];
        foreach ($item as $data) {
            PhuongThucThanhToan::firstOrCreate($data);
        }
    }
}
