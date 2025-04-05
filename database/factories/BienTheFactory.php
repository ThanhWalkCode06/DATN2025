<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BienThe>
 */
class BienTheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'san_pham_id' => $this->faker->numberBetween(1, 50),
            // 'thuoc_tinh_id' => $this->faker->numberBetween(1, 2),
            // 'gia_tri_thuoc_tinh_id' => $this->faker->numberBetween(1, 8),
            'ten_bien_the' => $this->faker->name(),
            // 'gia_nhap' => $this->faker->numberBetween(100000, 199999),
            'gia_ban' => $this->faker->numberBetween(200000, 999999),
            'so_luong' => $this->faker->randomNumber(3)
        ];
    }
}
