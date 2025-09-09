<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Product::all();

        return view('components.products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        return view('components.products.show', ['product' => $product]);
    }
}
