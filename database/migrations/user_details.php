<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('fname', 120);
            $table->string('lname', 120);
            $table->integer('mobile');
            $table->string('dob', 120);
            $table->string('email', 120);
            $table->string('pwd', 120);
            $table->string('address', 120);
            $table->string('city', 120);
            $table->string('state', 120);
            $table->string('pincode', 120);
            $table->string('created_at', 120);
            $table->string('updated_at', 120);
            $table->integer('status');
        });
    }

    public function down(): void
    {
        Schema::drop('user_details');
    }
};
