<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use NumberFormatter;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::orderBy('created_at', 'DESC')->get();

        foreach ($barangs as $barang) {
            $formattedHarga = 'Rp. ' . number_format($barang->harga, 0, ',', '.');
            $barang->formatted_harga = $formattedHarga;
        }

        return view('Admin.barang.index', compact('barangs'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris=Kategori::orderBy('created_at', 'DESC')->get();
        return view('Admin.barang.create', compact('kategoris'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        $formattedHarga = 'Rp. ' . number_format($barang->harga, 0, ',', '.');
        $barang->formatted_harga = $formattedHarga;
         
        return view('Admin.barang.show', compact('barang'));
    }

    public function store(Request $request)
    {
        try{
        $request->validate([
            'merk_barang' => 'required',
            'id_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('gambar')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['gambar'] = "images/$profileImage";
        }

        $barang = new Barang();
        $barang->merk_barang = $input['merk_barang'];
        $barang->deskripsi = $input['deskripsi'];
        $barang->gambar = $input['gambar'];
        $barang->id_kategori = $input['id_kategori'];
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Ditambahkan');
    }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Barang Gagal Dihapus!!!' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $kategoris=Kategori::orderBy('created_at', 'DESC')->get();

        return view('Admin.barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_barang)
    {
        try{
 
            $barang = Barang::findOrFail($id_barang);
        
            $request->validate([
                'merk_barang' => 'required',
                'jumlah_barang' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required',
                'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'id_kategori' => 'required',
            ]);
        
            $input = $request->all();
        
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move('images/', $profileImage);
                $input['gambar'] = "images/$profileImage";
            } else {
                // Retain the existing image path
                $input['gambar'] = $barang->gambar;
            }
        
            $barang->update($input);
            return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Diupdate');
        }catch (\Exception $e) {
                return redirect()->back()->with('error', 'Data Barang Gagal Diupdate!!! silahkan isi semua field');
            }
        
        
}


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang)
    {
        try{
        $barangs = Barang::findOrFail($id_barang);

        $barangs->delete();

        return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Dihapus');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Barang Gagal Dihapus!!! parent row');
        }
    }
}