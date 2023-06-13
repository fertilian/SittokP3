<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    public $table = "beli";
    protected $fillable = [
        
        'jumlah_beli',
        'harga_beli',
        'id_barang',
        'id_supplier',
        
    ];

    protected $primaryKey = 'id_supplier';
}
