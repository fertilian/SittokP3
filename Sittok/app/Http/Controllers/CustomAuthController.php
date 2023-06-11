<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function loginn()
    {
         return view('loginn');
    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password'  => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login Berhasil');

        }return back()->with('error', 'Email or Password salah');
    }
}