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
        }

        return redirect()->route('beli.index')->with('success', 'Data Pembelian Berhasil Ditambahkan');
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
       
        $beli = Beli::findOrFail($id);
        $barangs=barang::orderBy('created_at', 'DESC')->get();
        $suppliers=supplier::orderBy('created_at', 'DESC')->get();

        return view('Admin.beli.edit', compact('beli', 'barangs', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beli = Beli::findOrFail($id);

        $beli->update($request->all());

        return redirect()->route('beli.index')->with('success', 'Data Pembelian Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $belis = beli::findOrFail($id);

        $belis->delete();

        return redirect()->route('beli.index')->with('success', 'Data Pembelian Berhasil Dihapus');
    }
}
