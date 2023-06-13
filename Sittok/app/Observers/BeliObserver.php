<?php

namespace App\Observers;
use App\Models\Barang;
use App\Models\Beli;

class BeliObserver
{
    /**
     * Handle the Beli "created" event.
     */
    public function created(Beli $beli): void
    {
        $barang = Barang::findOrFail($beli->id_barang);
        $barang->increment('jumlah_barang', $beli->jumlah_beli);
    }
    /**
     * Handle the Beli "updated" event.
     */
    public function updated(Beli $beli): void
    {
        //
    }

    /**
     * Handle the Beli "deleted" event.
     */
    public function deleted(Beli $beli): void
    {
        //
    }

    /**
     * Handle the Beli "restored" event.
     */
    public function restored(Beli $beli): void
    {
        //
    }

    /**
     * Handle the Beli "force deleted" event.
     */
    public function forceDeleted(Beli $beli): void
    {
        //
    }
}
