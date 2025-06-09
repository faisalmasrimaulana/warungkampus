<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('weekly_subscribes', function (Blueprint $table) {
        $table->id();
        $table->string('order_id')->unique();
        $table->unsignedBigInteger('product_id');
        $table->string('nama_pemilik_produk');
        $table->string('email_pemilik_produk');
        $table->integer('harga');
        $table->string('status')->default('pending');
        $table->timestamps();

        $table->foreign('product_id')->references('id')->on('produk')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_subscribes');
    }
};
