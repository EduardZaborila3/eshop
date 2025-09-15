<?php

use App\Models\Company;
use App\Models\Order;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->index();
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(Recipient::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->enum('status', ['draft', 'created', 'delivered', 'cancelled'])->index();
            $table->integer('total_items');
            $table->decimal('total_amount', 10, 2);
            $table->string('currency', 3);
            $table->integer('quantity_per_product')->default(0);
            $table->datetime('status_synced_at')->nullable();
            $table->datetime('deleted_at')->nullable()->default(null);
            $table->timestamp('placed_at')->index();
            $table->timestamp('updated_at')->nullable()->default(now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
