<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beli;
use App\Models\Barang;
use App\Models\Supplier;
class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $belis=beli::orderBy('created_at', 'DESC')->get();
        
        foreach ($belis as $beli) {
            $formattedHarga = 'Rp. ' . number_format($beli->harga_beli, 0, ',', '.');
            $beli->formatted_harga = $formattedHarga;
        }

        return view('Admin.beli.index', compact('belis'));

        $beli = Beli::find($id);

        $merk_barang = $beli->barang->merk_barang;
        $nama_supplier = $beli->supplier->nama_Supplier;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs=barang::orderBy('created_at', 'DESC')->get();
        $suppliers=supplier::orderBy('created_at', 'DESC')->get();
        return view('Admin.beli.create', compact('barangs', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $beli = Beli::create([
            'tgl_beli' => $request->tgl_beli,
            'jumlah_beli' => $request->jumlah_beli,
            'harga_beli' => $request->harga_beli,
            'id_barang' => $request->id_barang,
            'id_supplier' => $request->id_supplier,
        ]);
    
        // Tambahkan jumlah barang pada tabel 'barang' berdasarkan 'id_barang'
        $barang = Barang::findOrFail($request->id_barang);
        $barang->jumlah_barang += $request->jumlah_beli;
        $barang = Barang::findOrFail($request->id_barang);
        
        $hargaBeli = $beli->harga_beli;

        // Hitung harga jual
        $persentaseHargaJual = 0.23; // 23%
        $hargaJual = round($hargaBeli + ($hargaBeli * $persentaseHargaJual));

        // Simpan harga jual ke dalam field yang sesuai pada tabel barang
        $barang->harga = $hargaJual;

        $barang->save();

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
