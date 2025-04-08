<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BinhLuan;
use App\Models\User;
use App\Models\BaiViet;
use Faker\Factory as Faker;

class BinhLuanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $userIds = User::pluck('id')->toArray();
        $baiVietIds = BaiViet::pluck('id')->toArray();

        if (empty($userIds) || empty($baiVietIds)) {
            return;
        }

        for ($i = 0; $i < 5; $i++) {
            BinhLuan::create([
                'bai_viet_id' => $faker->randomElement($baiVietIds),
                'user_id' => $faker->randomElement($userIds),
                'parent_id' => null,
                'noi_dung' => $faker->sentence(10),
                'trang_thai' => 1,
            ]);
        }
    }
}
