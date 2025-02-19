<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ho_ten' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'mat_khau' => static::$password ??= Hash::make('password'),
            'ngay_sinh' => $this->faker->dateTime(),
            'so_dien_thoai' => $this->faker->phoneNumber(),
            'gioi_tinh' => $this->faker->numberBetween(0, 1),
            'dia_chi' => $this->faker->address(),
            'quyen' => $this->faker->numberBetween(0, 1),
            'trang_thai' => $this->faker->numberBetween(0, 1),
            'remember_token' => Str::random(10)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
