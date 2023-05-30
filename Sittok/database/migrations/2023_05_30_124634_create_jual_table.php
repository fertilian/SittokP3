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
            $table->dateTime('tanggal_jual');
            $table->string('id_barang');
            $table->string('no_pesanan');
            $table->string('id_customer');
            $table->string('total_harga');
            $table->string('status_pesanan');
            $table->string('bukti_pembayaran');
            $table->timestamps();
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
