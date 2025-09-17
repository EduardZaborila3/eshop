<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\OrderService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatus implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Order $order) {}

    public $tries = 10;
    public $retryAfter = 30;

    /**
     * Execute the job.
     */
    public function handle(OrderService $orderService): void
    {
        //TODO Move to .env si mai multe
        $apiUrl = "https://undiscovered-api.hungrybytes.co/api/orders/{$this->order->id}";

        try {
            $response = $orderService->getApiResponse($apiUrl);

            if ($response->successful()) {
                $data = $response->json('data');
                $orderService->updateOrderStatus($this->order, $data['status']);
                Log::info("Order {$this->order->id} updated to status: {$data['status']}");
            } else {
                Log::info("Failed to fetch order {$this->order->id}. Status: {$response->status()}");
                throw new Exception("API returned 500 for order {$this->order->id}");
            }
        } catch (\Exception $e) {
            Log::error("Exception while fetching order {$this->order->id}: " . $e->getMessage());
        }
    }
}
