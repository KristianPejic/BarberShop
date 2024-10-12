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
            'name' => 'teo',
            'email' => 'teo@zad.ba',
            'password' => 'admin',
            'admin' => true,
        ]);
        User::factory()->create([
            'name' => 'kiko',
            'email' => 'kiko@ericsson.ba',
            'password' => 'user',
            'admin' => false,
        ]);
        User::factory()->create([
            'name' => 'kikoadmin',
            'email' => 'kikoadmin@ericsson.ba',
            'password' => 'admin',
            'admin' => true,
        ]);


        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
