<?php

namespace Database\Seeders;

use App\Models\BienThe;
use App\Models\SanPham;
use Illuminate\Database\Seeder;
use App\Models\BienTheThuocTinh;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BienTheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Lấy tất cả sản phẩm
    $sanPhams = SanPham::all();

    // Lấy danh sách giá trị thuộc tính từ bảng gia_tri_thuoc_tinhs
    $thuocTinh1Values = DB::table('gia_tri_thuoc_tinhs')->where('thuoc_tinh_id', 1)->pluck('id')->toArray();
    $thuocTinh2Values = DB::table('gia_tri_thuoc_tinhs')->where('thuoc_tinh_id', 2)->pluck('id')->toArray();

    $bienTheData = [];
    $bienTheThuocTinhData = [];

    // Lặp qua từng sản phẩm để tạo biến thể chính xác
    foreach ($sanPhams as $sanPham) {
        foreach ($thuocTinh1Values as $tt1) {
            foreach ($thuocTinh2Values as $tt2) {
                // Tạo biến thể mới
                $bienThe = BienThe::create([
                    'san_pham_id' => $sanPham->id,
                    'ten_bien_the' => "Biến thể $tt1 - $tt2",
                    'gia_nhap' => rand(10000, 19999),
                    'gia_ban' => rand(20000, 99999),
                    'so_luong' => rand(1, 100),
                ]);

                // Ghi nhận các thuộc tính của biến thể này vào bảng bien_the_thuoc_tinh
                $bienTheThuocTinhData[] = [
                    'bien_the_id' => $bienThe->id,
                    'thuoc_tinh_id' => 1,
                    'gia_tri_thuoc_tinh_id' => $tt1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $bienTheThuocTinhData[] = [
                    'bien_the_id' => $bienThe->id,
                    'thuoc_tinh_id' => 2,
                    'gia_tri_thuoc_tinh_id' => $tt2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
    }

    // Insert dữ liệu vào bảng bien_the_thuoc_tinh
    if (!empty($bienTheThuocTinhData)) {
        BienTheThuocTinh::insert($bienTheThuocTinhData);
    }
}

}
