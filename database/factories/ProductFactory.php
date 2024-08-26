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
            'name' => fake()->name(),
            'description' => fake()->paragraph(1),
            'logo' => 'resources/images/product.png',
            'price' => fake()->randomElement(['15,00', '20,00', '30,00', '40,00']),
            'discount_price' => null,
            'availability' => true,
        ];
    }
}