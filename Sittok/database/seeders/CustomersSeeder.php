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
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    	      
    		\App\Models\Customer::create([
    			'nama_customer' => $faker->name,
    			'no_telp_customer' => $faker->phoneNumber,
    			'alamat' => $faker->address,
    		]);
    }
}
}
