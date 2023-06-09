<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            LevelsTableSeeder::class   
        ]);

        $this->call([
            UsersTableSeeder::class
        ]);

        $this->call([
            KategorisTableSeeder::class   
        ]);
        
        $this->call([
            SuppliersTableSeeder::class
        ]);

        $this->call([
            BarangsTableSeeder::class   
        ]);
        
        $this->call([
            BeliSeeder::class
        ]);

        $this->call([
            CustomersSeeder::class
        ]);

        $this->call([
            KeranjangSeeder::class
        ]);

       

    }
}
