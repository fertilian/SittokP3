<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Paymen::create([
            'jenis_paymen' => 'Brimo',
            'no_paymen' => '89892387809',
            'icon' => 'images/brimo.jpg',
        ]);
    }
}
