<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER update_jumlah_barang AFTER INSERT ON detil_jual
        FOR EACH ROW
        BEGIN
            UPDATE barang SET jumlah_barang = jumlah_barang - NEW.qty WHERE id_barang = NEW.id_barang;
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_jumlah_barang');
    }
};
