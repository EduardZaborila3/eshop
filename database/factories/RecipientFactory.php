<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipientFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address_data' => [
                'street' => fake()->streetAddress(),
                'street_number' => fake()->buildingNumber(),
                'city' => fake()->city(),
                'postal_code' => fake()->postcode(),
                'country' => fake()->country()
            ],
            'notes' => fake()->text(100)
        ];
    }
}
