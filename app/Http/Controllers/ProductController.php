<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Company;
use App\Models\Product;
use App\Services\ProductService;

class ProductController
{
    public function __construct(protected ProductService $productService) {}
    public function index()
    {
        $query = $this->productService->getProducts();
        $query = $this->productService->whereActive($query, request()->input('is_active'));

        $products = $this->productService->search($query);
        $query = $this->productService->fromCompany($query);

        $products = $this->productService->applyOrdering($query)
            ->simplePaginate($this->productService->perPage());

        return view('products.index', [
            'products' => $products,
            'companies' => Company::all(),
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        $products = Company::all();
        return view('products.create', ['companies' => $products]);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->productService->storeProduct($request->validated());

//        Mail::to($job->employer->user)->queue(new JobPosted($job));

            return redirect()->route('products.show', ['product' => $product])
                ->with('success', 'Product created successfully!');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Product $product) {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        try {
            $product = $this->productService->updateProduct($product, $request->validated());

            return redirect()->route('products.show', ['product' => $product])
                ->with('success', 'Product updated successfully!');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')
                ->with('success', 'Product deleted successfully!');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
