<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beli;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $belis = Beli::orderBy('created_at', 'DESC')->get();

        foreach ($belis as $beli) {
            $formattedHarga = 'Rp. ' . number_format($beli->harga_beli, 0, ',', '.');
            $beli->formatted_harga = $formattedHarga;

            $totalPembelian = Beli::select(DB::raw('SUM(jumlah_beli * harga_beli) as total_pembelian'), 'id_barang')
                ->groupBy('id_barang')
                ->get();
        }

        return view('Admin.beli.index', compact('belis', 'totalPembelian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::orderBy('created_at', 'DESC')->get();
        $suppliers = Supplier::orderBy('created_at', 'DESC')->get();
        return view('Admin.beli.create', compact('barangs', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_supplier' => 'required',
                'id_barang.*' => 'required',
                'jumlah_beli.*' => 'required',
                'harga_beli.*' => 'required',
            ]);

            // Retrieve the input values
            $idSupplier = $request->input('id_supplier');
            $idBarangs = $request->input('id_barang');
            $jumlahBelis = $request->input('jumlah_beli');
            $hargaBelis = $request->input('harga_beli');

            // Loop through each input and create a new Beli record
            foreach ($idBarangs as $key => $idBarang) {
                $beli = new Beli();
                $beli->id_supplier = $idSupplier;
                $beli->id_barang = $idBarang;
                $beli->jumlah_beli = $jumlahBelis[$key];
                $beli->harga_beli = $hargaBelis[$key];
                $beli->save();

                // Update the harga_jual in the barang table
                $barang = Barang::findOrFail($idBarang);
                $barang->harga = $hargaBelis[$key] * 1.13; // Set harga_jual as 13% more than harga_beli
                $barang->save();

                // Update the quantity of the purchased item in the 'barang' table
                $barang->increment('jumlah_barang', $jumlahBelis[$key]);
            }

        return redirect()->route('beli.index')->with('success', 'Data Pembelian Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Pembelian Gagal Ditambahkan!!! silahkan isi semua field');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_beli)
    {
        $beli = Beli::findOrFail($id_beli);

        // Format harga_beli menjadi mata uang
        $formattedHarga = 'Rp. ' . number_format($beli->harga_beli, 0, ',', '.');
        $beli->formatted_harga = $formattedHarga;

        $jumlahBeli = $beli->jumlah_beli;
        $hargaBeli = $beli->harga_beli;
        
        $total = $jumlahBeli * $hargaBeli;

        // Format total menjadi mata uang
        $formattedTotal = 'Rp. ' . number_format($total, 0, ',', '.');
        
        return view('Admin.beli.show', compact('beli', 'formattedTotal'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
        $beli = Beli::findOrFail($id);
        $beli->created_at = date('Y-m-d');
        $barangs=barang::orderBy('created_at', 'DESC')->get();
        $suppliers=supplier::orderBy('created_at', 'DESC')->get();

        return view('Admin.beli.edit', compact('beli', 'barangs', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $beli = Beli::findOrFail($id);

            $beli->jumlah_beli = $request->input('jumlah_beli');
            $beli->harga_beli = $request->input('harga_beli');
            $beli->id_barang = $request->input('id_barang');
            $beli->id_supplier = $request->input('id_supplier');

            $beli->save();

            return redirect()->route('beli.index')->with('success', 'Data Pembelian Berhasil Diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Pembelian Gagal Diupdate!!! silahkan isi semua field ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $belis = beli::findOrFail($id);

            $belis->delete();

            return redirect()->route('beli.index')->with('success', 'Data Pembelian Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Pembelian Gagal Dihapus' . $e->getMessage());
        }
    }
}
