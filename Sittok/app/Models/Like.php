<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $table = "Likes";
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_barang',
    ];
}
