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

        \App\Models\User::create([
            'name' => 'vira',
            'email' => 'test@absen.com',
            'role' => 'admin',
            'password' => bcrypt(123),
        ]);
        \App\Models\User::create([
            'name' => 'ravi',
            'email' => 'test@absen.com',
            'role' => 'user',
            'password' => bcrypt(123),
        ]);
    }
}
