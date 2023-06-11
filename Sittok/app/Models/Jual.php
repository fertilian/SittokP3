<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    public $table = "jual";
    use HasFactory;

    protected $fillable = [
        'no_pesanan',
        'tanggal_jual',
        'id_barang',
        'harga',
        'qty',
        'total',
        'harga_bayar',
        'id_customer',
        'alamat',
        'no_hp',
        'bukti_bayar',
        'status',
        'id',
        'nama_lengkap',
       
    ];

    protected $primaryKey = 'id_jual';
}
