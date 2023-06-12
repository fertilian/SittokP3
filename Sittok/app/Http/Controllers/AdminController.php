<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Jual;
use App\Models\Beli;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Barang::count();
        $saiki = Carbon::now()->toDateString();
        $currentDate = Carbon::now()->format('Y-m-d');
        $totalHargaBayar = Jual::whereDate('tanggal_jual', $currentDate)
            ->value('harga_bayar');
        $income = 'Rp. ' . number_format($totalHargaBayar, 0, ',', '.');

        $jumlahPesananPending = Jual::where('status', 'Pending')->count();

        $currentMonth = Carbon::now()->format('m');
        $laba = Jual::join('beli', 'jual.id_barang', '=', 'beli.id_barang')
            ->select(DB::raw('(jual.harga - beli.harga_beli) * jual.qty AS laba_total'))
            ->whereMonth('jual.tanggal_jual', '=', $currentMonth)
            ->value('laba_total');
        $hargaFormatted = 'Rp. ' . number_format($laba, 0, ',', '.');
        
        $sum = Barang::sum('jumlah_barang');

        // Contoh pengambilan data penjualan dari database
        $jual = DB::table('jual')
        ->select('status', DB::raw('COUNT(*) as total'))
        ->groupBy('status')
        ->get();

        // Mengambil data status dan total dari objek penjualan
        $status = $jual->pluck('status');
        $total = $jual->pluck('total');

        return view ('Admin.index', compact('status', 'total', 'income', 'jumlahPesananPending', 'hargaFormatted', 'sum', 'saiki'));
       
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
