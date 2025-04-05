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
            'ma_san_pham' => $this->faker->ean13(),
            'khuyen_mai' => $this->faker->numberBetween(0, 99),
            'gia_cu' => $this->faker->numberBetween(200000, 300000),
            // 'gia_moi' => $this->faker->numberBetween(100000, 199999),
            'mo_ta' => $this->faker->paragraph(),
            'danh_muc_id' => $this->faker->numberBetween(1, 4),
            'trang_thai' => $this->faker->numberBetween(0, 1)
        ];
    }
}
