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
        return view('Admin.kategori.list', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminn.kategori.input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        kategori::create($request->all());

        return redirect()->route('Admin/kategori/list')->with('success', 'Kategori berhasil ditambahkan');
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
        $kategoris = kategori::findOrFail($id);

        $kategoris->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully');
    }
}
