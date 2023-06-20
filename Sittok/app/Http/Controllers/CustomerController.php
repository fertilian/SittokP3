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
        $defaultValues = [
            'profil' => asset('images/cust.png'),
        ];
        return view('Admin.customers.create', $defaultValues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make('sittok123');
        
        if (!$request->hasFile('profil')) {
            // Jika tidak ada file gambar yang diunggah, set profil menjadi gambar default
            $data['profil'] = 'images/cust.png';
        }

        customer::create($data);

            return redirect()->route('customers.index')->with('success', 'Data Customer Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Customer Gagal Ditambahkan!!! silahkan isi semua field');
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

    public function resetPassword($id_customer)
    {
        try {
            $customer = Customer::findOrFail($id_customer);

            // Set password customer to "sittok123"
            $customer->password = Hash::make('sittok123');
            $customer->save();

            return redirect()->back()->with('success', 'Password Customer has been reset.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reset password for the customer.');
        }
    }


}
