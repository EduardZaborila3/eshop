<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'sku' => fake()->unique()->bothify('SKU-####-????'),
            'price' => fake()->randomFloat(2, 1, 1000),
            'currency' => fake()->randomElement(['USD', 'EUR', 'GBP', 'RON']),
            'stock' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(70)
        ];
    }
}
