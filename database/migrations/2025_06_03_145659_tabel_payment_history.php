<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('order_id'); // ID order dari sistem kamu
            $table->unsignedBigInteger('product_id'); // ID produk yang dibeli
            $table->string('transaction_status');
            $table->string('payment_type');
            $table->integer('gross_amount');
            $table->timestamp('transaction_time')->nullable();
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone');
            $table->timestamps();

            // Kalau mau bikin relasi ke produk, bisa aktifkan ini:
            // $table->foreign('product_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
};
