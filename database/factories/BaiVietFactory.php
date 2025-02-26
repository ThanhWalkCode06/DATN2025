<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BaiViet>
 */
class BaiVietFactory extends Factory
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
            'tieu_de' => $this->faker->word(),
            'danh_muc_id' => $this->faker->numberBetween(1, 10),
            'noi_dung' => $this->faker->paragraph()
        ];
    }
}
