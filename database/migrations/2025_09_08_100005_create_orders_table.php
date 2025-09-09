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
            $table->id();
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(Recipient::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->enum('status', ['draft', 'created', 'delivered', 'cancelled']);
            $table->integer('total_items');
            $table->decimal('total_amount', 10, 2);
            $table->string('currency', 3);
            $table->datetime('placed_at');
            $table->datetime('status_synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
