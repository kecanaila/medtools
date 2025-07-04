<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Category::firstOrCreate(['name' => 'Medical Equipment']);
        \App\Models\Category::firstOrCreate(['name' => 'Diagnostics']);
        \App\Models\Category::firstOrCreate(['name' => 'Surgical Instruments']);
        \App\Models\Category::firstOrCreate(['name' => 'Personal Care']);
        \App\Models\Category::firstOrCreate(['name' => 'Pharmaceuticals']);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
