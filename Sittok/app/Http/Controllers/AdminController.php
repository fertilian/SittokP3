<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Jual;
use App\Models\Beli;
use App\Models\User;
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
        $totalHargaBayar = Jual::whereDate('created_at', $currentDate)
            ->value('total_final');
        $income = 'Rp. ' . number_format($totalHargaBayar, 0, ',', '.');

        $currentDate = Carbon::now()->format('Y-m-d');

        $pengeluaran = DB::table('beli')
        ->whereDate('created_at', $currentDate)
        ->select(DB::raw('SUM(jumlah_beli * harga_beli) as total_pengeluaran'))
        ->value('total_pengeluaran');

        $jumlahPesananPending = Jual::where('status', 'dibayar')->count();

       
        
        $sum = Barang::sum('jumlah_barang');

        // Contoh pengambilan data penjualan dari database
        $jual = DB::table('jual')
        ->select('status', DB::raw('COUNT(*) as total'))
        ->groupBy('status')
        ->get();

        // Mengambil data status dan total dari objek penjualan
        $status = $jual->pluck('status');
        $total = $jual->pluck('total');
        $user = User::first();
        return view ('Admin.index', compact('status', 'total', 'income', 'jumlahPesananPending', 'sum', 'pengeluaran', 'user'));
       
        
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
