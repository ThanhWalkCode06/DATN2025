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
        PhieuGiamGia::create([
            'ma_phieu' => 'COD1234567',
            'ten_phieu' => 'Tân thủ',
            'gia_tri' => 20,
            'muc_giam_toi_da' => 50000,
            'muc_gia_toi_thieu' => 100000,
            'mo_ta' => 'cho người mới',
            'trang_thai' => 1,
        ]);
        PhieuGiamGia::factory()->count(20)->create();
    }
}
