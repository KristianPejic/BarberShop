<?php

namespace Database\Factories;

use App\Models\Category;
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
            'category_id' => Category::factory(),
            'name' => fake()->name(),
            'description' => fake()->paragraphs(3, true),
            'photo' => 'photos/beard-balm.png',
            'price' => fake()->randomElement(['15,00', '20,00', '30,00', '40,00']),
            'discount_price' => null,
            'availability' => true,
        ];
    }
}