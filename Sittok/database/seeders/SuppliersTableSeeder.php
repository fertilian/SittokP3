<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;
class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    	      
    		\App\Models\Supplier::create([
    			'nama_supplier' => $faker->company,
    			'no_telp_supplier' => $faker->phoneNumber,
    			'alamat' => $faker->address,
    		]);
    }
}}
