<?php

namespace App\Http\Controllers;

use App\Models\Order;

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
}
