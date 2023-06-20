<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jual;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Keranjang;
use App\Models\DetileJual;
class JualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juals = Jual::orderBy('created_at', 'DESC')->get();

        foreach ($juals as $jual) {
            $formattedHarga = 'Rp. ' . number_format($jual->total_final, 0, ',', '.');
            $jual->formatted_harga = $formattedHarga;
        }

        return view('Admin.jual.index', compact('juals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs=barang::orderBy('created_at', 'DESC')->get();
        $customers=customer::orderBy('created_at', 'DESC')->get();
        $keranjangs=keranjang::orderBy('created_at', 'DESC')->get();
        return view('Admin.jual.create', compact('customers', 'barangs', 'keranjangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $request->validate([
            'tanggal_jual' => 'required',
            'id_barang' => 'required',
            'no_pesanan' => 'required',
            'id_customer' => 'required',
            'total' => 'required',
            'status'=> 'required',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('bukti_bayar')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') .".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['bukti_bayar'] = "$profileImage";
        }

        jual->create($input);

        $barang = Barang::findOrFail($request->id_barang);
        $barang->jumlah_barang += $request->jumlah_beli;
        $barang->save();
        return redirect()->route('jual.index')->with('success', 'Data Jual Berhasil Ditambahkan');
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'Data Jual Gagal Ditambahkan!!!' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id_jual)
    {
        $jual = Jual::with('detilJual.barang')->findOrFail($id_jual);

        $detilJual = $jual->detilJual ?? [];
    
        return view('Admin.jual.show', compact('jual', 'detilJual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_jual)
    {
        $jual = Jual::findOrFail($id_jual);

        return view('Admin.jual.edit', compact('jual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_jual)
    {
        try{
            $jual = Jual::findOrFail($id_jual);
            $jual->status = $request->input('status');
            $jual->save();

        return redirect()->route('jual.index')->with('success', 'Status Data Jual Berhasil Diupdate');
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'Data Jual Gagal Diupdate!!!' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_jual)
    {
        try{
        $juals = jual::findOrFail($id_jual);

        $juals->delete();

        return redirect()->route('jual.index')->with('success', 'Data Jual Berhasil Dihapus');
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'Data Jual Gagal Dihapus!!!' . $e->getMessage());
    }
    }
}
