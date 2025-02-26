<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DanhMucBaiViet>
 */
class DanhMucBaiVietFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ten_danh_muc' => $this->faker->name(),
            'mo_ta' => $this->faker->text()
        ];
    }
}
