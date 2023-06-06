<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=customer::orderBy('created_at', 'DESC')->get();
        return view('Admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Data Customer Berhasil Ditambahkan');
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
    public function edit(string $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        return view('Admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Data Customer Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        $customers= customer::findOrFail($id_customer);

        $customers->delete();

        return redirect()->route('customers.index')->with('success', 'Data Customer Berhasil Dihapus');
    }
}
