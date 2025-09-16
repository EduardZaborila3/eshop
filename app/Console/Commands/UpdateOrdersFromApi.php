<?php

namespace App\Console\Commands;

use App\Jobs\UpdateOrderStatus;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Console\Command;

class UpdateOrdersFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-orders-from-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch jobs to update orders status from external API';

    /**
     * Execute the console command.
     */
    public function handle(OrderService $orderService)
    {
        $orders = $orderService->ordersWithStatus('created');

        foreach ($orders as $order) {
            UpdateOrderStatus::dispatch($order);
        }

        $this->info('All orders dispatched to jobs.');
    }
}
