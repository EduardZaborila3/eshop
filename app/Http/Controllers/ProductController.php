<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Company;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        $id = Auth::id();
        $ip = request()->ip();
        Log::info("User with ID {$id} accessed the products index page. IP: {$ip}");

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

            $id = Auth::id();
            $productId = $product->id;
            $ip = request()->ip();
            Log::info("User with ID {$id} added a new product with ID {$productId}. IP: {$ip}");

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

            $id = Auth::id();
            $productId = $product->id;
            $ip = request()->ip();
            Log::info("User with ID {$id} updated product with ID {$productId}. IP: {$ip}");

            return redirect()->route('products.show', ['product' => $product])
                ->with('success', 'Product updated successfully!');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->orders()->count() > 0) {
                return redirect()->back()->with('error', 'This product cannot be deleted because it is part of an order.');
            }
            $product->delete();

            $id = Auth::id();
            $productId = $product->id;
            $ip = request()->ip();
            Log::info("User with ID {$id} deleted product with ID {$productId}. IP: {$ip}");

            return redirect()->route('products.index')
                ->with('success', 'Product deleted successfully!');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
