<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers=supplier::orderBy('created_at', 'DESC')->get();
        return view('Admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Data Supplier Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Supplier Gagal Ditambahkan!!! silahkan isi semua field');
        }
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
    public function edit(string $id_supplier)
    {
        $supplier = Supplier::findOrFail($id_supplier);

        return view('Admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_supplier)
    {
        try {
            $supplier = Supplier::findOrFail($id_supplier);

            $supplier->update($request->all());

            return redirect()->route('supplier.index')->with('success', 'Data Supplier Berhasil Diupdate');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Supplier Gagal Diupdate!!! silahkan isi semua field ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_supplier)
    {
        try {
            $suppliers = supplier::findOrFail($id_supplier);

            $suppliers->delete();

            return redirect()->route('supplier.index')->with('success', 'Data Supplier Berhasil Dihapus');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Supplier Gagal Dihapus!!! parent row');
        }
    }
}
