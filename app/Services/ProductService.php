<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Product;

class ProductService
{
    public function getProducts()
    {
        return Product::query();
    }

    public function search($query)
    {
        $term = '%' . request()->input('name') . '%';
        if (request()->filled('name')) {
            return $query->where('name', 'LIKE', $term)->orWhere('sku', 'LIKE', $term);
        }

        return $query;
    }

    public function fromCompany($query)
    {
        $companyName = request()->input('company');

        if ($companyName) {
            $companyId = Company::where('name', $companyName)->value('id');
            if ($companyId) {
                $query->where('company_id', $companyId);
            }
        }

        return $query;
    }

    public function perPage()
    {
        return request()->input('per_page', 15);
    }
    public function orderBy()
    {
        $allowed = ['name', 'price', 'created_at'];

        $col = request()->input('order_by', 'name');

        return in_array($col, $allowed, true) ? $col : 'name';
    }

    public function direction()
    {
        $dir = strtolower(request()->input('direction', 'asc'));
        if (request()->input('order_by') == 'created_at') {
            return $dir === 'desc' ? 'asc' : 'desc';
        }
        return $dir === 'desc' ? 'desc' : 'asc';
    }

    public function applyOrdering($query)
    {
        $column = $this->orderBy();
        $dir = $this->direction();

        if ($column === 'name') {
            return $query->orderByRaw("name {$dir}");
        }

        return $query->orderBy($column, $dir);
    }

    public function whereActive($query, $isActive)
    {
        if ($isActive != null && $isActive != '') {
            $query->where('is_active', $isActive);
        }
        return $query;
    }
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

    public function updateProduct(Product $product, array $data): Product
    {
        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'currency' => $data['currency'],
            'stock' => $data['stock'],
            'is_active' => $data['is_active']
        ]);

        return $product;
    }
}
