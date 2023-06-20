<?php

namespace Database\Seeders;
use App\Models\Customer;
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
        Customer::create([
            'nama_customer' => 'Ria',
            'email' => 'ria@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('ria'),
            'profil' => 'images/g1.jpg',
            
        ]);

        Customer::create([
            'nama_customer' => 'Sindi',
            'email' => 'sindi@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('sindi'),
            'profil' => 'images/g2.jpg',
        ]);

        Customer::create([
            'nama_customer' => 'Karina',
            'email' => 'karina@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('karina'),
            'profil' => 'images/g3.jpg',
        ]);

        Customer::create([
            'nama_customer' => 'Fertilia',
            'email' => 'fertilia@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('fertilia'),
            'profil' => 'images/g4.jpg',
        ]);

        Customer::create([
            'nama_customer' => 'Nizar',
            'email' => 'nizar@gmail.com',
            'no_telp_customer' => ' 081234582780',
            'alamat' => 'Jember',
            'password' => bcrypt('nizar'),
            'profil' => 'images/csnizar.jpg',
        ]);
    }
}
