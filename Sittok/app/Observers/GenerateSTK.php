<?php

namespace App\Observers;
use App\Models\Jual;
class GenerateSTK
{
    public function creating(Jual $model)
    {
        $model->no_pesanan = 'STK' . uniqid();
    }
}
