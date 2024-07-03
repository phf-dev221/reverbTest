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

        User::factory()->create([
            'name' => 'Karim',
            'email' => 'user1@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'Ryann',
            'email' => 'user2@gmail.com',
        ]);


        User::factory()->create([
            'name' => 'Miriem',
            'email' => 'user3@gmail.com',
        ]);
    }
}
