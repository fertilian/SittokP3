<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use Faker\Factory as Faker;
class BarangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\Barang::create([
            'merk_barang' => 'Charger Asus',
            'jumlah_barang' => '5',
            'harga' => '200000',
            'deskripsi' => 'Adaptor laptop ASUS A456U  DC output 19V 3.42A, 65Watt DC connector 4.0 * 1.35 mm (sedikit lebih kecil drpd yg standard 5.5*2.5mm) Kualitas : Original Garansi : 3 Bulan',
            'gambar' =>'images/charger-asus.jpg',
            'id_kategori' => '4',
        ]);

        \App\Models\Barang::create([
            'merk_barang' => 'Charger HP',
            'jumlah_barang' => '20',
            'harga' => '150000',
            'deskripsi' => 'Output : 19.5V - 4.62A 90W Input : 100-240v 1.6a Ukuran Konektor : 4.5*3.0mm Blue Pin Kualitas : Original Kondisi : Baru (New) Garansi : 3 Bulan',
            'gambar' =>'images/charger-hp.jpg',
            'id_kategori' => '4',
        ]);

        \App\Models\Barang::create([
            'merk_barang' => 'Logitech Keyboard',
            'jumlah_barang' => '20',
            'harga' => '245000',
            'deskripsi' => 'Logitech MK215 Wireless Combo Logitech telah menghadirkan berbagai jenis keyboard baik keyboard kabel maupun wireless yang membantu dan memudahkan Anda dalam menyelesaikan pekerjaan. Apabila Anda mencari keyboard yang terbaik, Logitech MK215 Mouse Combo and Wireless Keyboard. Sangat mudah digunakan tentu saja akan mempercepat pekerjaan Anda.',
            'gambar' =>'images/keyboard.jpg',
            'id_kategori' => '2',
        ]);

        \App\Models\Barang::create([
            'merk_barang' => 'Keyboard Gaming Meca',
            'jumlah_barang' => '12',
            'harga' => '379000',
            'deskripsi' => 'MECA 6 RGB  Main Feature  • 60% Layout Mini Keyboard • Magnetic Frame Cover • RGB LED Light • Outemu Removable Switch • Type-C Detachable • Tricolor Keycaps Combination',
            'gambar' =>'images/keyboard-gaming.jpg',
            'id_kategori' => '2',
        ]);

        \App\Models\Barang::create([
            'merk_barang' => 'Printer HP DeskJet Ink',
            'jumlah_barang' => '15',
            'harga' => '174000',
            'deskripsi' => 'HP memperkenalkan generasi terbaru dari seri printer Deskjet Ink Advantage All-in-One, perangkat pencetakan ideal untuk pengguna yang mengutamakan gaya dan selalu terkoneksi dengan internet.',
            'gambar' =>'images/HP Deskjet Ink Advantage 2135.png',
            'id_kategori' => '3',
        ]);


        
}}
