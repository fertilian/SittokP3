<?php

namespace App\Http\Controllers\api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_customer'      => 'required',
            'nama_customer'    => 'required',
            'email'            => 'required|email|unique:users',
            'no_telp_customer' => 'required',
            'alamat'           => 'required',
            'password'         => 'required',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $customer = customer::create([
            'id_customer'      => 'required',
            'nama_customer'    => 'required',
            'email'            => 'required|email|unique:users',
            'no_telp_customer' => 'required',
            'alamat'           => 'required',
            'password'         => 'required',
        ]);

        //return response JSON user is created
            if ($customer) {
                $response = array(
                    'success' => true,
                    'message' => 'Berhasil melakukan Registrasi ' .$customer->nama_customer,
                );
        return response()->json($response);
        //return JSON process insert failed 
            } else {
        $response = array(
            'success' => false,
            'message' => 'Registrasi Gagal',
        );
        return response()->json($response);
}
}
}