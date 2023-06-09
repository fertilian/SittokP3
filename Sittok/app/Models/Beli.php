<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    public $table = "beli";
    use HasFactory;

    protected $fillable = [
        'tgl_beli',
        'jumlah_beli',
        'harga_beli',
        'id_barang',
        'id_supplier',
       
    ];

    protected $primaryKey = 'id_beli';
}
