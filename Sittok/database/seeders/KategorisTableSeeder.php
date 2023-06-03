<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Kategori::create([
            'nama_kategori' => 'Laptop',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Keyboard',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Printer',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Charger',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Webcam',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Mouse',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Speaker',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Monitor',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'USB',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => 'Harddisk',
        ]);
    }
}
