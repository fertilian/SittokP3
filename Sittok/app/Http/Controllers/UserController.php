<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        $user = User::first(); // Get the first user from the collection
        
        return view('Admin.user.index', compact('users', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('Admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'email' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
                'poto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_fullname' => 'required',
            ]);

            $input = $request->all();

            if ($request->filled('password')) {
                $input['password'] = bcrypt($request->input('password'));
            } else {
                // Retain the existing password
                unset($input['password']);
            }

            if ($request->hasFile('poto')) {
                $image = $request->file('poto');
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move('images/', $profileImage);
                $input['poto'] = "images/$profileImage";
            } else {
                // Retain the existing image path
                $input['poto'] = $user->poto;
            }

            $user->update($input);
            return redirect()->route('user.index')->with('success', 'Data User Berhasil Diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data User Gagal Diupdate!!! Silahkan isi semua field. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus');
    }
}
