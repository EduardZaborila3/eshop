<?php

namespace App\Services;

use App\Models\Product;

class OrderService
{
    public function getProducts($company)
    {
        return Product::where('company_id', $company)->get();
    }
}
