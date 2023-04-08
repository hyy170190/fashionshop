<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'category' => $this->faker->randomElement(['Clothing', 'Electronics', 'Home', 'Books']),
            'color' => $this->faker->randomElement(['Red', 'Blue', 'Green', 'Yellow']),
            'size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'material' => $this->faker->randomElement(['Cotton', 'Polyester', 'Wool', 'Leather']),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
