<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris=kategori::orderBy('created_at', 'DESC')->get();
        return view('Admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategoris = kategori::findOrFail($id);

        return view('Admin.kategori.show', compact('kategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoris = kategori::findOrFail($id);

        return view('Admin.kategori.edit', compact('kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kategori)
    {
        $kategoris = kategori::findOrFail($id_kategori);

        $kategoris->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Diupdate');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoris = kategori::findOrFail($id);

        $kategoris->delete();

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Dihapus');
    }
}
