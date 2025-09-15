<?php

use App\Models\Company;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained();
            $table->string('name')->index();
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2)->index();
            $table->enum('currency', ['EUR', 'USD', 'RON']);
            $table->integer('stock');
            $table->boolean('is_active')->index();
            $table->datetime('deleted_at')->nullable()->default(null);
            $table->timestamps();
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
