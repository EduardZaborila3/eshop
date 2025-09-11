<?php

namespace App\Http\Controllers;

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
        return view('orders.create', ['recipients' => Recipient::all(), 'products' => $products]);
    }

    public function store()
    {
        //
    }
}
