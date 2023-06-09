<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    public $table = "keranjang";
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_barang',
        'merk_barang',
        'qty',
        'harga',
        'gambar',
        
    ];

    protected $primaryKey = 'id_keranjang';
}
