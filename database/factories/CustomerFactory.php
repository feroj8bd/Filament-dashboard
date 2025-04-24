<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'division' => $this->faker->randomElement(['Dhaka', 'Mymensingh', 'Rajshahi']),
            'district' => $this->faker->randomElement(['Dhaka Inside', 'Mymensingh Sadar', 'Rajshahi Sadar']),
            'area' => $this->faker->randomElement(['Dhaka Inside', 'Mymensingh Sadar', 'Rajshahi Sadar']),
            'status' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}