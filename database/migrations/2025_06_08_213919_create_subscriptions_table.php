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
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id();
        $table->string('subscription_id')->unique();
        $table->string('nama_pengguna');
        $table->string('email_pengguna');
        $table->string('no_hp_pengguna');
        $table->text('alamat_pengguna');
        $table->string('package_type'); // weekly / monthly
        $table->json('product_ids')->nullable(); // biar bisa nyimpen banyak produk
        $table->integer('harga');
        $table->string('status')->default('pending'); // pending, success, failed
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
