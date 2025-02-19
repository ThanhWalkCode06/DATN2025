<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SanPham>
 */
class SanPhamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ten_san_pham' => $this->faker->name(),
            'gia_san_pham' => $this->faker->randomNumber(5, true),
            'gia_khuyen_mai' => $this->faker->randomNumber(4, true),
            'so_luong' => $this->faker->randomNumber(2, true),
            'luot_xem' => $this->faker->randomNumber(4, false),
            'mo_ta' => $this->faker->paragraph(),
            'danh_muc_id' => $this->faker->randomNumber(1, true),
            'trang_thai' => $this->faker->numberBetween(0, 1)
        ];
    }
}
