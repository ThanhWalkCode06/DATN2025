<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhieuGiamGia>
 */
class PhieuGiamGiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ma_phieu' => $this->faker->ean13(),
            'ten_phieu' => $this->faker->word(),
            'ngay_bat_dau' => $this->faker->date(),
            'ngay_ket_thuc' => $this->faker->date(),
            'gia_tri' => $this->faker->numberBetween(1, 99),
            'mo_ta' => $this->faker->paragraph()
        ];
    }
}
