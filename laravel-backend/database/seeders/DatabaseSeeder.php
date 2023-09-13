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
        \App\Models\User::factory(5)->create(); //create 5 users

        \App\Models\Content::factory(5)->create(); //create 5 contents

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        \App\Models\User::factory()->create([ // create test admin user
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
    }
}
