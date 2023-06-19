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
        'qty',
        'status',
        
    ];

    protected $primaryKey = 'id_keranjang';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
