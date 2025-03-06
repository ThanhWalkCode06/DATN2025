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
            // 'gia_cu' => $this->faker->numberBetween(100000, 999999),
            // 'gia_moi' => $this->faker->numberBetween(100000, 999999),
            'mo_ta' => $this->faker->paragraph(),
            // 'form' => $this->faker->word(),
            // 'chat_lieu' => $this->faker->word(),
            'danh_muc_id' => $this->faker->randomNumber(1, true),
            'trang_thai' => $this->faker->numberBetween(0, 1)
        ];
    }
}
