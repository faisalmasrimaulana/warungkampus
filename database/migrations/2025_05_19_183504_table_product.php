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
        Schema::create('produk', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('kategori');
            $table->string('kondisi')->default('nocondition');
            $table->unsignedInteger('harga');
            $table->string('deskripsi_singkat');
            $table->string('deskripsi_lengkap');
            $table->timestamps();
            $table->string('path_fotoproduk');
            $table->boolean('is_sold')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
