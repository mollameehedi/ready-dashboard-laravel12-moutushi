<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->uniqid();
            $table->string('name');
            $table->integer('user_id')->nullable()->constrained('users');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->tinyInteger('delivary_area')->default(1);
            $table->integer('amount')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('shipping_charge')->default(0);
            $table->tinyInteger('order_status')->default(2);
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('payment_method')->default(1);
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
