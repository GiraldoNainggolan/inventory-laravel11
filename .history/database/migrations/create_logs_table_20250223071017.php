<?php
// database/migrations/xxxx_xx_xx_create_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('level'); // Log level (e.g., info, error, warning)
            $table->text('message'); // Log message
            $table->json('context')->nullable(); // Contextual data (optional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
}

