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
        Schema::create('detil_jual', function (Blueprint $table) {
            $table->id('id_detil_jual');
            $table->unsignedBigInteger('id_jual');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_keranjang');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('total_final');
            $table->timestamps();

            $table->foreign('id_jual')->references('id_jual')->on('jual');
            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjang');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_jual');
    }
};
