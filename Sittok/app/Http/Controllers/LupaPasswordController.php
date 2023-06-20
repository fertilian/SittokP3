<?php

namespace App\Http\Controllers;
use App\Models\User;
use Request;

class LupaPasswordController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        // Tambahkan kode untuk memperbarui kolom-kolom lainnya jika ada

        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'Pengguna berhasil diperbarui');
    }
}