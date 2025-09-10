<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->json('address_data')->nullable();
            $table->text('notes')->nullable();
            $table->datetime('deleted_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipients');
    }
};
