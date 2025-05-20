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
        } elseif ($user->role === 'organisateur') {
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
        'newUsersPercent' => 12,
        'newEventsPercent' => 8,
        'newRegistrationsPercent' => 15,
        'revenueGrowthPercent' => 22
    ];

    // Exemples d'activités récentes
    $recentActivities = collect([
        (object)[
            'type' => 'user',
            'title' => 'New user registered',
            'description' => 'A new user just joined the platform.',
            'created_at' => now()->subMinutes(30)
        ],
        (object)[
            'type' => 'event',
            'title' => 'New event created',
            'description' => 'An organizer published a new event.',
            'created_at' => now()->subHours(1)
        ],
    ]);

    // Approvals fictifs : à adapter à ton système de validation
    $pendingApprovals = Registration::where('status', 'pending')
        ->with('user') // Assure-toi que la relation 'user' existe
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.admin', compact('stats', 'recentActivities', 'pendingApprovals'));
}


    public function organizer()
    {
        $user = auth()->user();
        $organizerProfile = $user->organizerProfile;
        
        // Get upcoming events
        $upcomingEvents = $user->organizedEvents()
            ->where('start_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();
            
        // Get recent registrations across all events
        $eventIds = $user->organizedEvents()->pluck('id');
        $recentRegistrations = Registration::whereIn('event_id', $eventIds)
            ->with(['event', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Calculate statistics
        $stats = [
            'totalEvents' => $user->organizedEvents()->count(),
            'totalParticipants' => Registration::whereIn('event_id', $eventIds)->count(),
            'upcomingEvents' => $user->organizedEvents()->where('start_date', '>', now())->count(),
            'totalRevenue' => Registration::whereIn('event_id', $eventIds)->sum('total_price'),
            'newEventsPercent' => 15, // Placeholder values
            'newParticipantsPercent' => 10, // Placeholder values
            'revenueGrowthPercent' => 20, // Placeholder values
            'daysToNextEvent' => $upcomingEvents->first() ? now()->diffInDays($upcomingEvents->first()->start_date) : 0
        ];
        
        return view('dashboard.organizer', [
            'user' => $user,
            'profile' => $organizerProfile,
            'upcomingEvents' => $upcomingEvents,
            'recentRegistrations' => $recentRegistrations,
            'stats' => $stats
        ]);
    }

    public function organizerProfile()
    {
        // Redirect to the organizer dashboard instead
        return redirect()->route('organizer.dashboard');
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
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $stats = [
            'totalRegistrations' => $user->registrations()->count(),
            'upcomingEvents' => $user->registeredEvents()->where('start_date', '>', now())->count(),
            'totalTickets' => $user->registrations()->count(), // Each registration represents one ticket
            'totalNotifications' => $user->notifications()->count(),
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
        $user = auth()->user();
        
        if ($user->role === 'organisateur') {
            return $this->organizerProfile();
        } elseif ($user->role === 'participant') {
            return view('dashboard.participant.profile', [
                'userType' => $user->role
            ]);
        } elseif ($user->role === 'organizer') {
            return view('organizer.profile', [
                'userType' => $user->role
            ]);
        } else {
            return view('dashboard.profile', [
                'userType' => $user->role
            ]);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'required_with:password|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Remove current_password from validated data since we don't want to store it
        unset($validated['current_password']);
        
        // Only include password in the update if it was provided
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateOrganizerProfile(Request $request)
    {
        $user = auth()->user();
        $organizerProfile = $user->organizerProfile;
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'organization_name' => 'required|string|max:255',
            'organization_type' => 'required|string|max:255',
            'organization_description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'social_media' => 'nullable|string|max:255',
        ]);

        // Update user information
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Update organizer profile
        $organizerProfile->update([
            'organization_name' => $validated['organization_name'],
            'organization_type' => $validated['organization_type'],
            'organization_description' => $validated['organization_description'],
            'website' => $validated['website'],
            'social_media' => $validated['social_media'],
        ]);

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('organizer-logos', 'public');
            $organizerProfile->update(['logo' => $logoPath]);
        }

        return redirect()->route('organizer.dashboard')->with('success', 'Profile updated successfully');
    }
}