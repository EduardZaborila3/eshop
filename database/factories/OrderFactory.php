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
        return [
            'company_id' => null,
            'recipient_id' => null,
            'user_id' => null,
            'status' => fake()->randomElement(['draft', 'created', 'delivered', 'cancelled']),
            'total_items' => fake()->numberBetween(1, 20),
            'total_amount' => fake()->randomFloat(2, 10, 1000),
            'currency' => fake()->randomElement(['USD', 'EUR', 'GBP', 'RON']),
            'placed_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'status_synced_at' => fake()->optional()->dateTimeBetween('-1 month', 'now')
        ];
    }
}
