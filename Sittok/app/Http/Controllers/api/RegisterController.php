<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama_customer' => 'required|string',
            'email' => 'required|email',
            'no_telp_customer' => 'required|string',
            'password' => 'required',
        ]);

        // Create a new user
        $user = new User();

        $user->nama_customer = $request->nama_customer;
        $user->email = $request->email;
        $user->no_telp_customer = $request->no_telp_customer;
        $user->password = $request->password;
        $user->save();

        // Return a response
        return response()->json(['message' => 'Registration successful'], 201);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
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
