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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('merk_barang');
            $table->integer('jumlah_barang');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->unsignedBigInteger('id_kategori');
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
