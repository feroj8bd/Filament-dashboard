<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'image' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug(),
            'sku' => $this->faker->uuid(),
            'brand' => $this->faker->word(),
            'model' => $this->faker->word(),
            'color' => $this->faker->colorName(),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'status' => $this->faker->boolean(),
            'meta_title' => $this->faker->sentence(),
            'meta_description' => $this->faker->sentence(),
            'meta_image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}