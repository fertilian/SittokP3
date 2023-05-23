<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs=barang::orderBy('created_at', 'DESC')->get();
        return view('Admin.barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Ditambahkan');
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
    public function edit(string $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        return view('Admin.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang)
    {
        $barangs = barang::findOrFail($id_barang);

        $barangs->delete();

        return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Dihapus');
    }
}
