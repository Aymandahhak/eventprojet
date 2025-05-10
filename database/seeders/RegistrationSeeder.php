<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegistrationSeeder extends Seeder
{
    public function run()
    {
        $participant = User::where('role', 'participant')->first();
        
        // Get all events
        $events = Event::all();
        
        // Register the participant only for the first 2 events
        foreach ($events->take(2) as $event) {
            Registration::create([
                'event_id' => $event->id,
                'user_id' => $participant->id,
                'ticket_quantity' => rand(1, 3),
                'total_price' => $event->price * rand(1, 3),
                'status' => 'confirmed',
                'ticket_code' => Str::random(10),
                'payment_status' => 'paid',
            ]);
        }
    }
} 