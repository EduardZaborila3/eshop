<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;
use App\Services\OrderService;
use Illuminate\Support\Facades\Mail;

class OrderController
{
    public function __construct(protected OrderService $orderService) {}

    public function index()
    {
        $query = $this->orderService->getOrders();
        $query = $this->orderService->whereStatus($query, request()->input('status'));

        $orders = $this->orderService->search($query);

        $orders = $this->orderService->applyOrdering($query)
            ->simplePaginate($this->orderService->perPage());

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

    public function store(StoreOrderRequest $request)
    {
        try {
            $data = $request->validated();

            $productIds = $data['product_ids'];
            $quantityPerProduct = (int) $data['quantity_per_product'];

            $stockCheck = $this->orderService->checkStock($productIds, $quantityPerProduct);

            if ($stockCheck !== true) {
               throw new \Exception('Insufficient stock');
            }

            $data['total_items'] = $quantityPerProduct * count($productIds);
            $data['total_amount'] = $this->orderService->getTotalAmount($productIds) * $quantityPerProduct;
            $data['currency'] = $this->orderService->getCurrency($productIds);

            $data['quantity_per_product'] = $quantityPerProduct;
            $order = $this->orderService->storeOrder($data);

            $order->products()->attach($productIds);

            if ($data['status'] === 'created') {
                foreach ($productIds as $productId) {
                    $product = Product::find($productId);
                    $product->decrement('stock', $quantityPerProduct);
                }
            }

            $order->load('recipient', 'products', 'company');

            Mail::to($order->recipient->email)->queue(new OrderCreated($order));

            return redirect()->route('orders.show', ['order' => $order])
                ->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit(Order $order) {
        $companyProducts = $this->orderService->getProducts($order->company_id);
        $orderProductIds = $order->products->pluck('id')->toArray();

        return view('orders.edit', [
            'order' => $order,
            'companyProducts' => $companyProducts,
            'orderProductIds' => $orderProductIds
            ]);
    }

    public function update(Order $order, UpdateOrderRequest $request)
    {
        try {
            $data = $request->validated();

            $data['total_items']  = $this->orderService->getTotalItems($data['product_ids']);
            $data['total_amount'] = $this->orderService->getTotalAmount($data['product_ids']);
            $data['currency'] = $this->orderService->getCurrency($data['product_ids']);

            $updatedOrder = $this->orderService->updateOrder($order, $data);

            $updatedOrder->products()->sync($data['product_ids']);

            return redirect()->route('orders.show', ['order' => $updatedOrder])
                ->with('success', 'Order updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return redirect()->route('orders.index')
                ->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
