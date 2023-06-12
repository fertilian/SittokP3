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
            $table->string('no_pesanan');
            $table->date('tanggal_jual');
            $table->unsignedBigInteger('id_barang');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('total');
            $table->integer('harga_bayar');
            $table->unsignedBigInteger('id_customer');
            $table->string('alamat');
            $table->string('nohp');
            $table->string('bukti_bayar');
            $table->string('status');
            $table->unsignedBigInteger('id')->nullable();
            $table->string('nama_lengkap');
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->foreign('id')->references('id')->on('users');
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
