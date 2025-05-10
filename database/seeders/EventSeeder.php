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

        // Conference Events
        $conferenceEvents = [
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
                'image' => 'env1.jpg',
                'type' => 'Présentiel',
            ],
            [
                'title' => 'AI & Machine Learning Conference',
                'description' => 'Explore the future of artificial intelligence and machine learning technologies.',
                'category' => 'Conference',
                'start_date' => now()->addDays(45),
                'end_date' => now()->addDays(47),
                'location' => 'Tech Center, Seattle',
                'price' => 349.99,
                'capacity' => 450,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env9.jpg',
                'type' => 'Présentiel',
            ],
            [
                'title' => 'Startup Summit 2024',
                'description' => 'A conference for entrepreneurs, investors, and startup enthusiasts.',
                'category' => 'Conference',
                'start_date' => now()->addDays(60),
                'end_date' => now()->addDays(62),
                'location' => 'Innovation Hub, Boston',
                'price' => 249.99,
                'capacity' => 350,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env2.jpg',
                'type' => 'Hybride',
            ],
        ];

        // Workshop Events
        $workshopEvents = [
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
                'image' => 'env3.jpg',
                'type' => 'Virtuel',
            ],
            [
                'title' => 'UX/UI Design Masterclass',
                'description' => 'Learn advanced user experience and interface design principles.',
                'category' => 'Workshop',
                'start_date' => now()->addDays(25),
                'end_date' => now()->addDays(25),
                'location' => 'Design Studio, Los Angeles',
                'price' => 179.99,
                'capacity' => 40,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env10.jpg',
                'type' => 'Présentiel',
            ],
            [
                'title' => 'Mobile App Development Workshop',
                'description' => 'Master modern app development for iOS and Android platforms.',
                'category' => 'Workshop',
                'start_date' => now()->addDays(35),
                'end_date' => now()->addDays(35),
                'location' => 'Tech Campus, Austin',
                'price' => 159.99,
                'capacity' => 45,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env4.jpg',
                'type' => 'Virtuel',
            ],
        ];

        // Networking Events
        $networkingEvents = [
            [
                'title' => 'Business Networking Event',
                'description' => 'Connect with industry professionals and expand your business network.',
                'category' => 'Networking',
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(10),
                'location' => 'Grand Hotel, Chicago',
                'price' => 79.99,
                'capacity' => 200,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env5.jpg',
                'type' => 'Hybride',
            ],
            [
                'title' => 'Women in Tech Networking',
                'description' => 'Networking event focused on supporting and promoting women in technology.',
                'category' => 'Networking',
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(20),
                'location' => 'Diversity Center, New York',
                'price' => 49.99,
                'capacity' => 150,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env11.jpg',
                'type' => 'Présentiel',
            ],
            [
                'title' => 'Startup Mixer',
                'description' => 'Connect with founders, investors, and tech enthusiasts in a relaxed setting.',
                'category' => 'Networking',
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(30),
                'location' => 'Venture Space, San Francisco',
                'price' => 69.99,
                'capacity' => 175,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env6.jpg',
                'type' => 'Présentiel',
            ],
        ];

        // Seminar Events
        $seminarEvents = [
            [
                'title' => 'Digital Marketing Seminar',
                'description' => 'Learn the latest digital marketing strategies from industry experts.',
                'category' => 'Seminar',
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(20),
                'location' => 'Marketing Center, Los Angeles',
                'price' => 199.99,
                'capacity' => 100,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env7.jpg',
                'type' => 'Présentiel',
            ],
            [
                'title' => 'Cybersecurity Best Practices',
                'description' => 'Seminar on the latest trends and practices in information security.',
                'category' => 'Seminar',
                'start_date' => now()->addDays(40),
                'end_date' => now()->addDays(40),
                'location' => 'Security Academy, Washington DC',
                'price' => 229.99,
                'capacity' => 120,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env12.jpg',
                'type' => 'Hybride',
            ],
            [
                'title' => 'Leadership and Management',
                'description' => 'Develop your leadership skills and learn advanced management techniques.',
                'category' => 'Seminar',
                'start_date' => now()->addDays(50),
                'end_date' => now()->addDays(50),
                'location' => 'Business School, New York',
                'price' => 249.99,
                'capacity' => 80,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env8.jpg',
                'type' => 'Présentiel',
            ],
        ];

        // Training Events
        $trainingEvents = [
            [
                'title' => 'Data Science Bootcamp',
                'description' => 'Intensive bootcamp covering data analysis, machine learning, and AI applications.',
                'category' => 'Training',
                'start_date' => now()->addDays(60),
                'end_date' => now()->addDays(65),
                'location' => 'Online',
                'price' => 599.99,
                'capacity' => 30,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env13.jpg',
                'type' => 'Virtuel',
            ],
            [
                'title' => 'Full-Stack Web Development',
                'description' => 'Comprehensive training in modern front-end and back-end web technologies.',
                'category' => 'Training',
                'start_date' => now()->addDays(70),
                'end_date' => now()->addDays(75),
                'location' => 'Coding Academy, San Diego',
                'price' => 649.99,
                'capacity' => 25,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env14.jpg',
                'type' => 'Présentiel',
            ],
            [
                'title' => 'DevOps & Cloud Engineering',
                'description' => 'Learn modern DevOps practices and cloud platform management.',
                'category' => 'Training',
                'start_date' => now()->addDays(80),
                'end_date' => now()->addDays(85),
                'location' => 'Online',
                'price' => 579.99,
                'capacity' => 35,
                'is_published' => true,
                'organizer_id' => $organizer->id,
                'image' => 'env15.jpeg',
                'type' => 'Virtuel',
            ],
        ];

        // Combine all events
        $allEvents = array_merge(
            $conferenceEvents,
            $workshopEvents,
            $networkingEvents,
            $seminarEvents,
            $trainingEvents
        );

        // Create all events
        foreach ($allEvents as $event) {
            Event::create($event);
        }
    }
} 