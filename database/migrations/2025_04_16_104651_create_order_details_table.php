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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id') ->constrained('orders')->onDelete('cascade');
            $table->string('order_number');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('quantity');
            $table->string('title');
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->longText('review')->nullable();
            $table->enum('rating',[1,2,3,4,5])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
