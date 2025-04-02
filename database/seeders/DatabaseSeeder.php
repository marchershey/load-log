<?php

namespace Database\Seeders;

use App\Models\Lane;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create my account
        User::factory()->create([
            'username' => 'marchershey',
            'password' => Hash::make('password'),
        ]);

        // Create random user accounts
        User::factory(10)->create();

        // Create random lanes
        Lane::factory(10)->create();
    }
}
