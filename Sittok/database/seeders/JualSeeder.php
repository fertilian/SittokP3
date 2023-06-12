<?php

namespace Database\Seeders;
use App\Models\Barang;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Faker\Factory as Faker;


class JualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 10; $i++){

        $no_pesanan = $faker->randomNumber(8);
        $tanggal_jual = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
        $id_barang = $faker->randomElement(Barang::pluck('id_barang')->all());
        $harga = Barang::find($id_barang)->harga;
        $qty = $faker->randomNumber(2);
        $total = $harga * $qty;
        $harga_bayar = $total;
        $id_customer = $faker->randomElement(Customer::pluck('id_customer')->all());
        $nohp = Customer::find($id_customer)->no_telp_customer;
        $alamat = $faker->address();
        
        $bukti_bayar = $faker->imageUrl();
        $status = $faker->randomElement(['Pending', 'Diproses', 'Selesai']);
        $id = $faker->randomElement(['1']);
        $nama_lengkap = Customer::find($id_customer)->nama_customer;
        
        \App\Models\Jual::create([
            'no_pesanan' => $no_pesanan,
            'tanggal_jual' => $tanggal_jual,
            'id_barang' => $id_barang,
            'harga' => $harga,
            'qty' => $qty,
            'total' => $total,
            'harga_bayar' => $harga_bayar,
            'id_customer' => $id_customer,
            'alamat' => $alamat,
            'nohp' => $nohp,
            'bukti_bayar' => $bukti_bayar,
            'status' => $status,
            'id' => $id,
            'nama_lengkap' => $nama_lengkap,
        ]);
        
    }}
    
}
