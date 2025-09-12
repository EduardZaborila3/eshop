<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;
use App\Services\OrderService;

class OrderController
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order]);
    }

    public function create($company, OrderService $orderService)
    {
        $products = $orderService->getProducts($company);
        return view('orders.create', [
            'recipients' => Recipient::all(),
            'products' => $products,
            'company' => $company]);
    }

    public function store(StoreOrderRequest $request, OrderService $orderService)
    {
        $data = $request->validated();

        $data['total_items'] = $orderService->getTotalItems($data['product_ids']);
        $data['total_amount'] = $orderService->getTotalAmount($data['product_ids']);
        $data['currency'] = $orderService->getCurrency($data['product_ids']);

        $order = $orderService->storeOrder($data);

        $order->products()->attach($data['product_ids']);

        $order->load('recipient', 'products', 'company');

        return view('orders.show', ['order' => $order]);
    }

    public function edit(Order $order, OrderService $orderService) {
        $companyProducts = $orderService->getProducts($order->company_id);
        $orderProductIds = $order->products->pluck('id')->toArray();

        return view('orders.edit', [
            'order' => $order,
            'companyProducts' => $companyProducts,
            'orderProductIds' => $orderProductIds
            ]);
    }

    public function update(OrderService$orderService, Order $order, UpdateOrderRequest $request)
    {
        $data = $request->validated();

        $data['total_items']  = $orderService->getTotalItems($data['product_ids']);
        $data['total_amount'] = $orderService->getTotalAmount($data['product_ids']);
        $data['currency'] = $orderService->getCurrency($data['product_ids']);

        $updatedOrder = $orderService->updateOrder($order, $data);

        $updatedOrder->products()->sync($data['product_ids']);

        return view('orders.show', ['order' => $updatedOrder]);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect('/orders');
    }
}
