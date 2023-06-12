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
            'nama_customer' => 'Fertilia',
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

        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 200; $i++){
            $nama_customer = $faker->name;
            $email = $faker->unique()->safeEmail;
            $no_telp_customer = $faker->phoneNumber;
            $alamat = $faker->address;
            $password = bcrypt('password123'); // Contoh password, ganti dengan password yang sesuai

            Customer::create([
                'nama_customer' => $nama_customer,
                'email' => $email,
                'no_telp_customer' => $no_telp_customer,
                'alamat' => $alamat,
                'password' => $password,
            ]);

    }

    }
}
