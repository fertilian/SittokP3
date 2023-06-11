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
    
    protected $primaryKey = 'id';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
