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
        User::firstOrCreate(
            ['email' => 'admin@eventorg.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // Create Organizer
        User::firstOrCreate(
            ['email' => 'organizer@eventorg.com'],
            [
                'name' => 'Organizer User',
                'password' => Hash::make('organizer123'),
                'role' => 'organizer'
            ]
        );

        // Create Participant
        User::firstOrCreate(
            ['email' => 'participant@eventorg.com'],
            [
                'name' => 'Participant User',
                'password' => Hash::make('participant123'),
                'role' => 'participant'
            ]
        );
    }
} 