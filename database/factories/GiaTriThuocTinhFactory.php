<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GiaTriThuocTinh>
 */
class GiaTriThuocTinhFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'thuoc_tinh_id' => $this->faker->numberBetween(1, 5),
            'gia_tri' => $this->faker->word()
        ];
    }
}
