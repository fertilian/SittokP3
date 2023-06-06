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
        'total',
        'status',
        'bukti_bayar'
    ];

    protected $primaryKey = 'id_jual';
}
