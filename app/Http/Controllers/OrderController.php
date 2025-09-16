<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Mail\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        $id = Auth::id();
        $ip = request()->ip();
        Log::info("User with ID {$id} accessed the orders index page. IP: {$ip}");

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
            $quantityPerProduct = $data['quantity_per_product'];

            $stockCheck = $this->orderService->checkStock($productIds, $quantityPerProduct);

            if ($stockCheck !== true) {
               throw new \Exception('Insufficient stock');
            }

            $data['total_items'] = $this->orderService->totalItems(
                $data['quantity_per_product'],
                $data['product_ids']
            );
            $data['total_amount'] = $this->orderService->getTotalAmount(
                $productIds,
                $quantityPerProduct
            );
            $data['currency'] = $this->orderService->getCurrency($productIds);

            $data['quantity_per_product'] = $quantityPerProduct;
            $order = $this->orderService->storeOrder($data);

            $order->products()->attach($productIds);

            if ($data['status'] === 'created') {
                foreach ($productIds as $productId) {
                    $product = Product::find($productId);
                    $product->stock -= $quantityPerProduct;
                    $product->save();
                }
            }

            $order->load('recipient', 'products', 'company');

            Mail::to($order->recipient->email)->queue(new OrderCreated($order));

            $id = Auth::id();
            $orderId = $order->id;
            $ip = request()->ip();
            Log::info("User with ID {$id} created order with ID {$orderId}. IP: {$ip}");

            return redirect()->route('orders.show', ['order' => $order])
                ->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit(Order $order) {
        if ($order->status != 'draft') {
            abort(403, 'You cannot edit this order');
        }

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

            $productIds = $data['product_ids'];
            $quantityPerProduct = $data['quantity_per_product'];

            $stockCheck = $this->orderService->checkStock($productIds, $quantityPerProduct);

            if ($stockCheck !== true) {
                throw new \Exception('Insufficient stock');
            }

            $data['total_items']  = $this->orderService->getTotalItems($productIds);
            $data['total_amount'] = $this->orderService->getTotalAmount(
                $productIds,
                $quantityPerProduct
            );
            $data['currency'] = $this->orderService->getCurrency($productIds);
            $oldStatus = $order['status'];

            $updatedOrder = $this->orderService->updateOrder($order, $data);

            $updatedOrder->products()->sync($data['product_ids']);

            if (isset($data['status']) && $data['status'] !== $oldStatus) {
                $userId = Auth::id();
                Log::info("User with ID {$userId} changed order with ID {$updatedOrder->id} status from '{$oldStatus}' to '{$data['status']}'");
            }

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

            $userId = Auth::id();
            Log::info("User with ID {$userId} deleted order with ID {$order->id}. IP: {request()->ip()}");

            return redirect()->route('orders.index')
                ->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
