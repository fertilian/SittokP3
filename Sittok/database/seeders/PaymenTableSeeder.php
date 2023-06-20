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
            'icon' => 'images/brimo.png',
        ]);

        \App\Models\Paymen::create([
            'jenis_paymen' => 'Gopay',
            'no_paymen' => '081234582780',
            'icon' => 'images/gopay.png',
        ]);

        \App\Models\Paymen::create([
            'jenis_paymen' => 'Mandiri',
            'no_paymen' => '89892387809',
            'icon' => 'images/mandiri.png',
        ]);

        \App\Models\Paymen::create([
            'jenis_paymen' => 'Dana',
            'no_paymen' => '081234582780',
            'icon' => 'images/dana.png',
        ]);

        \App\Models\Paymen::create([
            'jenis_paymen' => 'Shopeepay',
            'no_paymen' => '081234582780',
            'icon' => 'images/ShopeePay.png',
        ]);

        \App\Models\Paymen::create([
            'jenis_paymen' => 'Ovo',
            'no_paymen' => '081234582780',
            'icon' => 'images/ovo.png',
        ]);
    }
}
