<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $table = "kategori";
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
    ];

    protected $primaryKey = 'id_kategori';
}
