<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DivisionController extends Controller
{
    public function getProvinces()
    {
        try {
            $response = Http::get('https://provinces.open-api.vn/api/p/');
            if ($response->successful()) {
                return response()->json($response->json());
            }
            return response()->json(['error' => 'Không thể lấy dữ liệu tỉnh/thành'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi kết nối API: ' . $e->getMessage()], 500);
        }
    }

    public function getDistricts($provinceId)
    {
        try {
            $response = Http::get("https://provinces.open-api.vn/api/p/{$provinceId}?depth=2");
            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data['districts'] ?? []);
            }
            return response()->json(['error' => 'Không thể lấy dữ liệu quận/huyện'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi kết nối API: ' . $e->getMessage()], 500);
        }
    }

    public function getWards($districtId)
    {
        try {
            $response = Http::get("https://provinces.open-api.vn/api/d/{$districtId}?depth=2");
            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data['wards'] ?? []);
            }
            return response()->json(['error' => 'Không thể lấy dữ liệu phường/xã'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi kết nối API: ' . $e->getMessage()], 500);
        }
    }
}
