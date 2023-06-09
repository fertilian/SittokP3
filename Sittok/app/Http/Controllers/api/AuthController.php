<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Customer;
use App\Models\Like;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $customer = DB::table('customers')
        ->where('email', $email)
        ->first();

    if ($customer) {
        if (Hash::check($password, $customer->password)) {
            $response = array(
                'success' => true,
                'message' => 'Selamat Datang ' . $customer->nama_customer,
                'data' => array(
                    'id_customer' => $customer->id_customer,
                    'nama_customer' => $customer->nama_customer,
                    'email' => $customer->email,
                    'no_telp_customer' => $customer->no_telp_customer,
                    'alamat' => $customer->alamat
                )
            );
            return response()->json($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Incorrect password',
            );
            return response()->json($response, 404);
        }
    }

    $response = array(
        'success' => false,
        'message' => 'User not found',
    );
    return response()->json($response, 404);
}
    
    public function register(Request $request)
    {
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $nama_customer = $request->input('nama_customer');
        $no_telp_customer = $request->input('no_telp_customer');
        $alamat = $request->input('alamat');
    
        // Validasi jika email sudah terdaftar sebelumnya
        $existingCustomer = DB::table('customers')
            ->where('email', $email)
            ->first();
    
        if ($existingCustomer) {
            $response = array(
                'success' => false,
                'message' => 'Email already registered',
            );
            return response()->json($response);
        }
    
        // Lakukan proses penyimpanan data customer ke database
    
        $customer = DB::table('customers')->insertGetId([
            'email' => $email,
            'password' => $password,
            'nama_customer' => $nama_customer,
            'no_telp_customer' => $no_telp_customer,
            'alamat' => $alamat
        ]);
        if ($customer) {
            $response = array(
                'success' => true,
                'message' => 'Registration successful',
                'data' => array(
                    'id_customer' => $customer,
                    'nama_customer' => $nama_customer,
                    'email' => $email,
                    'no_telp_customer' => $no_telp_customer,
                    'alamat' => $alamat
                )
            );
            return response()->json($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Registration failed',
            );
            return response()->json($response);
        }
    }
    public function getDataBarang(Request $request)
    {
        $barangs = Barang::all();

        if ($barangs->isEmpty()) {
            $response = array(
                'success' => false,
                'message' => 'No data found',
                'data' => null
            );
        } else {
            $response = array(
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $barangs
            );
        }

        return response()->json($response);
    }
    public function getDataKategori(Request $request)
    {
        $kategoris = Kategori::all();

        if ($kategoris->isEmpty()) {
            $response = array(
                'success' => false,
                'message' => 'No data found',
                'data' => null
            );
        } else {
            $response = array(
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $kategoris
            );
        }

        return response()->json($response);
    }
    public function addData(Request $request)
    {
        $data = $request->validate([
            'id_customer' => 'required',
            'id_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
        ]);

        $keranjang = Keranjang::create($data);

        return response()->json([
            'message' => 'Data added successfully',
            'data' => $keranjang
        ], 201);
    }

    public function getDataKeranjang(Request $request)
    {
        $data = $request->validate([
            'id_customer' => 'required',
            'id_barang' => 'required',
        ]);

        $keranjang = Keranjang::join('barang', 'keranjang.id_barang', '=', 'barang.id_barang')
            ->where('keranjang.id_customer', $data['id_customer'])
            ->where('keranjang.id_barang', $data['id_barang'])
            ->select('keranjang.*', 'barang.harga')
            ->first();

        if (!$keranjang) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        $jumlah = $keranjang->harga * $keranjang->qty;
        $keranjang->jumlah = $jumlah;

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $keranjang
        ], 200);
    }
    public function getDataLikes(Request $request)
    {
        $likes = Like ::all();

        if ($likes->isEmpty()) {
            $response = array(
                'success' => false,
                'message' => 'No data found',
                'data' => null
            );
        } else {
            $response = array(
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $likes
            );
        }

        return response()->json($response);
    }
    public function updateData(Request $request, $id)
    {
        $data = $request->validate([
            'nama_customer' => 'required',
            'no_telp_customer' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Customer not found'
            ], 404);
        }

        $customer->update($data);

        return response()->json([
            'message' => 'Data updated successfully',
            'data' => $customer
        ], 200);
    }
}