<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
      
    public function registerPost(Request $request)
    {  
        $user = new User();

        $user->email = $request->email;
        $user->password = $request->password;
        $user->user_fullname = $request->user_fullname;
        $user->telp = $request->telp;
        $user->id_level = '1';


        $user->save();
         
        return redirect('loginn')->with('success', 'Register Berhasil');
    }

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
            return redirect('/Admin/indexadmin')->with('success', 'Login Berhasil');

        }return back()->with('error', 'Email or Password salah');
    }
}