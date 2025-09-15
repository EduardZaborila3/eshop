<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        $totalItems = $this->faker->numberBetween(1, 20);
        return [
            'company_id' => null,
            'recipient_id' => null,
            'user_id' => null,
            'status' => fake()->randomElement(['draft', 'created', 'delivered', 'cancelled']),
            'total_items' => $totalItems,
            'total_amount' => fake()->randomFloat(2, 10, 1000),
            'currency' => fake()->randomElement(['USD', 'EUR', 'GBP', 'RON']),
            'status_synced_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'quantity_per_product' => $totalItems,
            'placed_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
