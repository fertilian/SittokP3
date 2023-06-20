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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login Berhasil');
        }

        return redirect('/loginn')->with('error', 'Email atau Password salah');
    }
    
    public function home()
    {
        if (Auth::check()) {
            return view('home');
        }
        
        return redirect('/loginn')->with('error', 'Anda harus login untuk mengakses halaman ini');
    }
}
