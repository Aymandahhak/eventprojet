<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@eventorg.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Create Organizer
        User::create([
            'name' => 'Organizer User',
            'email' => 'organizer@eventorg.com',
            'password' => Hash::make('organizer123'),
            'role' => 'organizer'
        ]);

        // Create Participant
        User::create([
            'name' => 'Participant User',
            'email' => 'participant@eventorg.com',
            'password' => Hash::make('participant123'),
            'role' => 'participant'
        ]);
    }
} 