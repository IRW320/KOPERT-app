<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'nickname' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '085731443209',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'nickname' => 'User',
            'email' => 'user@example.com',
            'phone' => '081224903320',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
