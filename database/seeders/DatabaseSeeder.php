<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\User;
use App\Models\Company;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(2)->create();
        User::factory(3)->create();
        Product::factory(6)->create();
        Recipient::factory(3)->create();
        Order::factory(10)->create();
    }
}
