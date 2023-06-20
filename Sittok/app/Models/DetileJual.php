<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetileJual extends Model
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

    public function jual()
    {
        return $this->belongsTo(Jual::class, 'id_jual');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang');
    }
}
