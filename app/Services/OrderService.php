<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\User;

class OrderService
{
    public function getOrders()
    {
        return Order::query();
    }

    public function getRecipients()
    {
        return Recipient::All();
    }

    public function ordersWithStatus($status)
    {
        return Order::where('status', $status)->get();
    }

    public function perPage()
    {
        return request()->input('per_page', 15);
    }

    public function search($query)
    {
        if (request()->filled('id')) {
            return $query->where('id', 'LIKE', '%' . request()->input('id') . '%');
        }

        return $query;
    }

    public function totalItems(int $quantityPerProduct, array $productIds): int
    {
        return $quantityPerProduct * count($productIds);
    }

    public function checkStock(array $productIds, int $quantityPerProduct): bool|string
    {
        $products = Product::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            if ($product->stock < $quantityPerProduct) {
                return "Not enough stock for product {$product->name}. Available: {$product->stock}";
            }
        }

        return true;
    }


    public function getProducts($company)
    {
        return Product::where('company_id', $company)->get();
    }

    public function whereStatus($query, $status)
    {
        if ($status != null && $status != '') {
            $query->where('status', $status);
        }
        return $query;
    }

    public function orderBy()
    {
        $allowed = ['id', 'placed_at'];
        $col = request()->input('order_by', 'id');
        return in_array($col, $allowed, true) ? $col : 'id';
    }

    public function direction()
    {
        $dir = strtolower(request()->input('direction', 'asc'));
        if (request()->input('order_by') == 'placed_at') {
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

    public function getRecipientById($recipient)
    {
        return Recipient::findOrFail($recipient)->name;
    }
    public function getTotalAmount(array $productIds, int $quantityPerProduct)
    {
        $total =  Product::whereIn('id', $productIds)->sum('price');
        return $total * $quantityPerProduct;
    }

    public function getTotalItems(array $productIds)
    {
        return Product::whereIn('id', $productIds)->count();
    }

    public function getCurrency(array $productIds)
    {
        $product = Product::whereIn('id', $productIds)->first();
        return $product ? $product->currency : 'USD';
    }

    public function getApiResponse($apiUrl)
    {
        return \Http::withHeaders([
            'x-api-key' => 'Hungrybytes',
        ])->get($apiUrl);
    }

    public function storeOrder(array $data)
    {
        return Order::create([
            'company_id' => $data['company_id'],
            'recipient_id' => $data['recipient_id'],
            'user_id' => auth()->user()->id,
            'status' => $data['status'],
            'total_items' => $data['total_items'],
            'total_amount' => $data['total_amount'],
            'quantity_per_product' => $data['quantity_per_product'],
            'currency' => $data['currency'],
            'placed_at' => $data['placed_at'],
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
    }

    public function updateOrder(Order $order, array $data)
    {
        $order->update([
            'status' => $data['status'],
            'total_items' => $data['total_items'],
            'total_amount' => $data['total_amount'],
            'quantity_per_product' => $data['quantity_per_product'],
            'updated_at' => now(),
        ]);

        return $order->fresh(); // reload the updated attributes
    }

    public function updateOrderStatus(Order $order, $status)
    {
        $order->update([
           'status' => $status,
           'status_synced_at' => now()
        ]);

        return $order->fresh();
    }
}
