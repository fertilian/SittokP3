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
        Schema::create('jual', function (Blueprint $table) {
            $table->id('id_jual');
            $table->integer('total');
            $table->integer('total_final');
            $table->string('alamat');
            $table->string('nohp');
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['belum bayar', 'dibayar', 'dikemas', 'dikirim', 'selesai'])->default('belum bayar');
            $table->unsignedBigInteger('id_keranjang');
            $table->string('nama_lengkap');
            $table->timestamps();
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjang');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jual');
    }
};
