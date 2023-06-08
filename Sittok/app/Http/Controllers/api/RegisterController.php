<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $customer = DB::table('customers')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($customer) {
            $response = array(
                'success' => true,
                'message' => 'Logged in successfully',
                'id_customer' => $customer->id_customer,
                'nama_customer' => $customer->nama_customer,
                'email' => $customer->email,
                'no_telp_customer' => $customer->no_telp_customer,
                'alamat' => $customer->alamat,
            );
            return response()->json($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'User not found or incorrect password',
            );
            return response()->json($response);
        }
    }
}