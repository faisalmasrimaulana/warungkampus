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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_id')->unique();
        $table->string('nama_pembeli');
        $table->string('email_pembeli');
        $table->string('no_hp_pembeli');
        $table->text('alamat_pembeli');
        $table->unsignedBigInteger('product_id');
        $table->integer('harga');
        $table->string('status')->default('pending');
        $table->timestamps();
        $table->text('catatan')->nullable();
        $table->foreign('product_id')->references('id')->on('produk')->onDelete('cascade');
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
