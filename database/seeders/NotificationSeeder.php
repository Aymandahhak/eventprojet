<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        foreach ($users as $user) {
            // Create welcome notification for each user
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Welcome to Event Management',
                'message' => 'Thank you for joining our platform. We hope you enjoy the experience!',
                'type' => 'info',
                'is_read' => false
            ]);

            // Create a second notification
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Complete Your Profile',
                'message' => 'Please take a moment to complete your profile information to get the most out of our platform.',
                'type' => 'warning',
                'is_read' => false
            ]);
        }
    }
}
