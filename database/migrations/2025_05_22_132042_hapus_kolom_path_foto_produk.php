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
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('path_foto_produk');
        });
    }

    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('path_foto_produk')->nullable();
        });
    }
};
