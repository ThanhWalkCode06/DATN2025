<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChiTietDonHang>
 */
class ChiTietDonHangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'don_hang_id' => $this->faker->numberBetween(1, 50),
            'bien_the_id' => $this->faker->numberBetween(1, 100),
            'so_luong' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-2 months', '+9 months')
        ];
    }
}
