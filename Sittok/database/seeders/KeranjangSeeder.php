<?php

namespace Database\Seeders;
use App\Models\Customer;
use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeranjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    		\App\Models\Keranjang::create([
    			'id_customer' => '3',
    			'id_barang' => '1',
    			'merk_barang' => 'Charger Asus',
                'qty' => rand(1, 3),
                'harga' => '200000',
                'gambar' => 'charger-asus.jpg',
    		]);
        
    }
}
