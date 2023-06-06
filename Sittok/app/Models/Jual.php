<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_jual',
        'id_barang',
        'no_pesanan',
        'id_customer',
        'total_harga',
        'status_pesanan',
        'bukti_pembayaran'
    ];

    protected $primaryKey = 'id_barang';
}
