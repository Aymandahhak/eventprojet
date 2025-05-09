<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return view('dashboard.admin');
        } elseif ($user->role === 'organizer') {
            return view('dashboard.organizer');
        } else {
            return view('dashboard.participant');
        }
    }

    public function admin()
    {
        $stats = [
            'totalUsers' => User::count(),
            'activeEvents' => Event::where('is_published', true)->count(),
            'totalRegistrations' => Registration::count(),
            'totalRevenue' => Registration::sum('total_price'),
            'newUsersPercent' => 12, // This should be calculated based on your needs
            'newEventsPercent' => 8,
            'newRegistrationsPercent' => 15,
            'revenueGrowthPercent' => 22
        ];

        return view('dashboard.admin', compact('stats'));
    }

    public function organizer()
    {
        $user = auth()->user();
        $stats = [
            'totalEvents' => $user->organizedEvents()->count(),
            'totalParticipants' => Registration::whereIn('event_id', $user->organizedEvents()->pluck('id'))->count(),
            'upcomingEvents' => $user->organizedEvents()->where('start_date', '>', now())->count(),
            'totalRevenue' => Registration::whereIn('event_id', $user->organizedEvents()->pluck('id'))->sum('total_price'),
            'newEventsPercent' => 25,
            'newParticipantsPercent' => 15,
            'revenueGrowthPercent' => 32,
            'daysToNextEvent' => 5
        ];

        return view('dashboard.organizer', compact('stats'));
    }

    public function participant()
    {
        $user = auth()->user();
        
        // Get event registrations
        $upcomingEvents = Registration::with('event')
            ->where('user_id', $user->id)
            ->whereHas('event', function($query) {
                $query->where('start_date', '>', now());
            })
            ->take(3)
            ->get();
            
        // Get recommended events (events the user hasn't registered for)
        $registeredEventIds = $user->registrations()->pluck('event_id')->toArray();
        $recommendedEvents = Event::where('is_published', true)
            ->where('start_date', '>', now())
            ->whereNotIn('id', $registeredEventIds)
            ->take(3)
            ->get();
            
        // Get user notifications
        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $stats = [
            'totalRegistrations' => $user->registrations()->count(),
            'upcomingEvents' => $user->registeredEvents()->where('start_date', '>', now())->count(),
            'totalTickets' => $user->registrations()->count(), // Each registration represents one ticket
            'totalNotifications' => \App\Models\Notification::where('user_id', $user->id)->count(),
            'daysToNextEvent' => $user->registeredEvents()->where('start_date', '>', now())->min('start_date') 
                ? now()->diffInDays($user->registeredEvents()->where('start_date', '>', now())->min('start_date'))
                : 0
        ];

        return view('dashboard.participant', compact('stats', 'upcomingEvents', 'recommendedEvents', 'notifications'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function events()
    {
        $events = Event::with('organizer')->paginate(10);
        return view('admin.events', compact('events'));
    }

    public function statistics()
    {
        return view('dashboard.statistics', [
            'userType' => auth()->user()->role
        ]);
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function profile()
    {
        return view('dashboard.profile', [
            'userType' => auth()->user()->role
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}