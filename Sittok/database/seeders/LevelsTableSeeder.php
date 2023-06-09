<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Levels::create([
            'ket' => 'Admin',
        ]);

        \App\Models\Levels::create([
            'ket' => 'User',
        ]);
    }
}
