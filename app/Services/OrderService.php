<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\User;

class OrderService
{
    public function getProducts($company)
    {
        return Product::where('company_id', $company)->get();
    }

    public function getRecipientById($recipient)
    {
        return Recipient::findOrFail($recipient)->name;
    }
    public function getTotalAmount(array $productIds)
    {
        return Product::whereIn('id', $productIds)->sum('price');
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

    public function storeOrder(array $data)
    {
        return Order::create([
            'company_id' => $data['company_id'],
            'recipient_id' => $data['recipient_id'],
            'user_id' => auth()->user()->id,
            'status' => $data['status'],
            'total_items' => $data['total_items'],
            'total_amount' => $data['total_amount'],
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
            'updated_at' => now(),
        ]);

        return $order->fresh(); // reload the updated attributes
    }
}
