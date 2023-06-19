<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymen extends Model
{
    public $table = "paymen";

    use HasFactory;

    protected $fillable = [
        'jenis_paymen',
        'no_paymen',
        'icon',
    ];
    
    protected $primaryKey = 'id';

}
