<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Jual;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Barang::count();
        $cst = Customer::count();
        $sup = Supplier::count();
        $tsk = Jual::count();
        $sum = Barang::sum('jumlah_barang');
        return view ('Admin.index', compact('count', 'cst', 'sup', 'tsk', 'sum'));
       
        
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
