<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChiTietGioHang>
 */
class ChiTietGioHangFactory extends Factory
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
            'bien_the_id' => $this->faker->numberBetween(1, 100),
            'so_luong' => $this->faker->numberBetween(1, 100)
        ];
    }
}
