<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Company;
use App\Models\Product;
use App\Services\ProductService;

class ProductController
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        $companies = Company::all();
        return view('products.create', ['companies' => $companies]);
    }

    public function store(StoreProductRequest $request, ProductService $productService)
    {
        $product = $productService->storeProduct($request->validated());

//        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return view('products.show', ['product' => $product]);
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
        $product->delete();

        return redirect('/products');
    }
}
