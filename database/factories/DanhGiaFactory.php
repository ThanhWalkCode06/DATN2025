<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DanhGia>
 */
class DanhGiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'san_pham_id' => $this->faker->numberBetween(1, 50),
            'so_sao' => $this->faker->numberBetween(1, 5),
            'nhan_xet' => $this->faker->paragraph(),
            'trang_thai' => $this->faker->numberBetween(0, 1)
        ];
    }
}
