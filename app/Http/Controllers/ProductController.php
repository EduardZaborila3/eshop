<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Product::where('deleted_at', null)->get();

        return view('products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        $companies = Company::where('deleted_at', null)
            ->where('is_active', true)
            ->get();

        return view('products.create', ['companies' => $companies]);
    }

    public function store(Product $product)
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'company_id' => ['required'],
            'currency' => ['required'],
            'stock' => ['required', 'numeric'],
            'is_active' => ['required']
        ]);

        $product = Product::create([
            'name' => request('name'),
            'price' => request('price'),
            'company_id' => request('company_id'),
            'currency' => request('currency'),
            'is_active' => request('is_active'),
            'stock' => request('stock'),
            'sku' => fake()->unique()->bothify('ID-####'),
            'deleted_at' => null
        ]);

//        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/products');
    }

    public function edit(Product $product) {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product)
    {
        // validate
        $validated = request()->validate([
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'currency' => ['required'],
            'stock' => ['required', 'numeric'],
            'is_active' => ['required']
        ]);

        // update the product
        $product->update($validated);

        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        $product->update(['deleted_at' => now()]);

        return redirect('/products');
    }
}
