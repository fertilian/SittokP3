<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'email' => 'sittok@gmail.com',
            'password' => 'admin',
            'user_fullname' => 'Admin Sittok',
            'telp' => ' 081234582780',
            'alamat' => 'Jember',
             
        ]);
    }
}
