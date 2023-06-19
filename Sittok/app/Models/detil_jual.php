<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detil_jual extends Model
{
    public $table = "detil_jual";

    use HasFactory;

    protected $fillable = [
        'id_jual',
        'id_barang',
        'id_keranjang',
        'jumlah',
        'harga',
        'qty',
        'total_final',
        
    ];
    
    protected $primaryKey = 'id_detil_jual';

}
