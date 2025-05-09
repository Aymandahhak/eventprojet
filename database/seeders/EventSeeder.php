<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        $organizer = User::where('role', 'organizer')->first();

        $events = [
            [
                'title' => 'Tech Conference 2024',
                'description' => 'Annual technology conference featuring the latest innovations and industry leaders.',
                'category' => 'Conference',
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(32),
                'location' => 'Convention Center, New York',
                'price' => 299.99,
                'capacity' => 500,
                'is_published' => true,
                'organizer_id' => $organizer->id,
            ],
            [
                'title' => 'Web Development Workshop',
                'description' => 'Hands-on workshop covering modern web development techniques and tools.',
                'category' => 'Workshop',
                'start_date' => now()->addDays(15),
                'end_date' => now()->addDays(15),
                'location' => 'Tech Hub, San Francisco',
                'price' => 149.99,
                'capacity' => 50,
                'is_published' => true,
                'organizer_id' => $organizer->id,
            ],
            [
                'title' => 'Business Networking Event',
                'description' => 'Connect with industry professionals and expand your business network.',
                'category' => 'Networking',
                'start_date' => now()->addDays(45),
                'end_date' => now()->addDays(45),
                'location' => 'Grand Hotel, Chicago',
                'price' => 79.99,
                'capacity' => 200,
                'is_published' => true,
                'organizer_id' => $organizer->id,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
} 