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
        Schema::create('monthly_subscribes', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_1_id');
            $table->unsignedBigInteger('product_2_id');
            $table->string('promo_message')->nullable();
            $table->integer('harga');
            $table->string('payment_status')->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_1_id')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('product_2_id')->references('id')->on('produk')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_subscribes');
    }
};
