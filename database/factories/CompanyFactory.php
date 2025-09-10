<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'slug' => fake()->unique()->bothify('SKU-##??'),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => [
                'street' => fake()->streetAddress(),
                'street_number' => fake()->buildingNumber(),
                'city' => fake()->city(),
                'postcode' => fake()->postcode(),
                'country' => fake()->country()
            ],
            'is_active' => fake()->boolean(70),
            'deleted_at' => null
        ];
    }
}
