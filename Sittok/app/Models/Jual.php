<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\GenerateSTK;

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
        'nohp',
        'bukti_bayar',
        'status',
        'id',
        'nama_lengkap',
       
    ];

    protected $primaryKey = 'id_jual';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->no_pesanan = 'STK' . uniqid();
    });
}
}
