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
            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->string('currency', 3);
            $table->integer('stock');
            $table->boolean('is_active');
            $table->datetime('deleted_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
