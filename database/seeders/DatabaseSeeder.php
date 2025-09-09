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
        $companies = Company::factory(2)->create();
        $users = User::factory(6)->create();
        $recipients = Recipient::factory(6)->create();

        $products = Product::factory(12)->make();
        $products->each(function ($product) use ($companies) {
            $product->company_id = $companies->random()->id;
            $product->save();
        });

        $orders = Order::factory(10)->make();
        $orders->each(function($order) use ($companies, $users, $recipients, $products) {
            $order->company_id = $companies->random()->id;
            $order->user_id = $users->random()->id;
            $order->recipient_id = $recipients->random()->id;
            $order->save();

            $order->products()->attach($products->random(rand(1,5))->pluck('id')->toArray());
        });
    }
}
