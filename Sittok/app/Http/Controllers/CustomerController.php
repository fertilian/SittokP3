<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        try {
            customer::create($request->all());

            return redirect()->route('customers.index')->with('success', 'Data Customer Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Customer Gagal Ditambahkan!!!'. $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        return view('Admin.customers.show', compact('customer'));
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
        try {
            $customer = Customer::findOrFail($id_customer);

            $customer->update($request->all());

            return redirect()->route('customers.index')->with('success', 'Data Customer Berhasil Diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Customer Gagal Diupdate!!! silahkan isi semua field ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        try {
            $customers= customer::findOrFail($id_customer);

            $customers->delete();

            return redirect()->route('customers.index')->with('success', 'Data Customer Berhasil Dihapus');
    
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Customer Gagal Dihapus!!! parent row');
        }
    }

    public function resetPassword(Request $request, string $id_customer)
    {
        try {
            $customer = Customer::findOrFail($id_customer);
            
            // Ubah password pengguna menjadi "customerpw123"
            $customer->password = Hash::make('customerpw123');
            $customer->save();

            return redirect()->back()->with('success', 'Password Customer Berhasil Diatur Ulang.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mengatur Ulang Password Customer!!!');
        }
    }
}
