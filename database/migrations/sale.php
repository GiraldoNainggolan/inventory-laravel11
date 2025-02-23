<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('customer_id', 11);
            $table->string('customer_name', 255);
            $table->string('user_name', 255);
            $table->string('customer_mobile', 15);
            $table->string('sale_bill', 50);
            $table->string('sale_date', 50);
            $table->decimal('total_amount', total: 10, places: 2);
            $table->string('sale_created_at', 120);
            $table->string('sale_updated_at', 120);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale');
    }
};
