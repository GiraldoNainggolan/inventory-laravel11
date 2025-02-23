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
        Schema::create('item', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('item_name', 120);
            $table->string('item_hsn', 120);
            $table->string('item_unit', 120);
            $table->string('item_desc', 520);
            $table->integer('item_mrp');
            $table->integer('item_purchase');
            $table->integer('item_sale');
            $table->integer('item_stock');
            $table->string('item_created_at', 120);
            $table->string('item_updated_at', 120);
            $table->integer('item_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
