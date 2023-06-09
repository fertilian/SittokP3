<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Customer::create([
            'nama_customer' => 'Ria',
            'email' => 'ria@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('ria'),
            
        ]);

        \App\Models\Customer::create([
            'nama_customer' => 'Sindi',
            'email' => 'sindi@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('sindi'),
            
        ]);

        \App\Models\Customer::create([
            'nama_customer' => 'Karina',
            'email' => 'karina@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('karina'),
            
        ]);

        \App\Models\Customer::create([
            'nama_customer' => 'Fertilian',
            'email' => 'fertilia@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('fertilia'),
            
        ]);

        \App\Models\Customer::create([
            'nama_customer' => 'Nizar',
            'email' => 'nizar@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('nizar'),
            
        ]);

    }
}
