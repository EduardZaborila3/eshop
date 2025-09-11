<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function storeProduct(array $data): Product
    {
        return Product::create([
            'name' => request('name'),
            'price' => request('price'),
            'company_id' => request('company_id'),
            'currency' => request('currency'),
            'is_active' => request('is_active'),
            'stock' => request('stock'),
            'sku' => fake()->unique()->bothify('ID-####'),
            'deleted_at' => null
        ]);
    }
}
