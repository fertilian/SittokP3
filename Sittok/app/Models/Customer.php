<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_customer',
        'no_telp_customer',
        'alamat',
        'email',
        'password',
    ];

    protected $primaryKey = 'id_customer';

    public function setPasswordAttribute($value)
    {
    $this->attributes['password'] = bcrypt($value);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_customer');
    }
}
