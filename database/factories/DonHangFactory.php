<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DonHang>
 */
class DonHangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ma_don_hang' => $this->faker->ean13(),
            'user_id' => $this->faker->numberBetween(1, 50),
            'ten_nguoi_nhan' => $this->faker->name(),
            'email_nguoi_nhan' => $this->faker->email(),
            'sdt_nguoi_nhan' => $this->faker->phoneNumber(),
            'dia_chi_nguoi_nhan' => $this->faker->address(),
            'tong_tien' => $this->faker->numberBetween(100000, 10000000),
            'ghi_chu' => $this->faker->text(),
            'phuong_thuc_thanh_toan_id' => $this->faker->numberBetween(1, 2),
            'trang_thai_don_hang' => $this->faker->numberBetween(-1, 5),
            'trang_thai_thanh_toan' => $this->faker->numberBetween(0, 1)
        ];
    }
}
