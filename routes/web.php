<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;

// Public routes
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/service', function () {
    return view('service');
})->name('service');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/feature', function () {
    return view('feature');
})->name('feature');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/attraction', function () {
    return view('attraction');
})->name('attraction');

Route::get('/package', function () {
    return view('package');
})->name('package');

Route::get('/team', function () {
    return view('team');
})->name('team');

Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Event routes - no authentication required for now
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
    
    // Routes for creating and managing events
    Route::get('/create/new', [EventController::class, 'create'])->name('events.create');
    Route::post('/', [EventController::class, 'store'])->name('events.store');
    Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    
    // Additional event actions
    Route::put('/{event}/publish', [EventController::class, 'publish'])->name('events.publish');
    Route::put('/{event}/unpublish', [EventController::class, 'unpublish'])->name('events.unpublish');
    Route::get('/{event}/duplicate', [EventController::class, 'duplicate'])->name('events.duplicate');
});

// Registration routes - no authentication required for now
Route::prefix('registrations')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/create/{event}', [RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('/{event}', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/{registration}', [RegistrationController::class, 'show'])->name('registrations.show');
    Route::post('/{registration}/cancel', [RegistrationController::class, 'cancel'])->name('registrations.cancel');
    Route::get('/{registration}/ticket', [RegistrationController::class, 'downloadTicket'])->name('registrations.ticket');
});

// Participant routes
Route::prefix('participant')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        // Mock data for now
        $stats = [
            'totalRegistrations' => 12,
            'upcomingEvents' => 5,
            'totalTickets' => 8,
            'totalCertificates' => 3,
            'daysToNextEvent' => 7
        ];
        
        return view('dashboard.participant', [
            'stats' => $stats
        ]);
    })->name('participant.dashboard');
    
    // Registrations & Events
    Route::get('/registrations', function () {
        return view('events.participant-registrations');
    })->name('participant.registrations');
    
    // Tickets
    Route::get('/tickets', function () {
        return view('events.participant-tickets');
    })->name('participant.tickets');
    
    // Certificates
    Route::get('/certificates', function () {
        return view('events.participant-certificates');
    })->name('participant.certificates');
    
    // Download ticket
    Route::get('/tickets/{registration}/download', function ($registration) {
        // Implementation will be added later
        return back()->with('info', 'Ticket download feature will be implemented soon');
    })->name('participant.tickets.download');
    
    // Profile
    Route::get('/profile', function () {
        return view('dashboard.profile', ['userType' => 'participant']);
    })->name('participant.profile');
});

// Organizer routes
Route::prefix('organizer')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        // Mock data for now
        $stats = [
            'totalEvents' => 8,
            'totalParticipants' => 120,
            'upcomingEvents' => 3,
            'totalRevenue' => 15000,
            'newEventsPercent' => 25,
            'newParticipantsPercent' => 15,
            'revenueGrowthPercent' => 32,
            'daysToNextEvent' => 5
        ];
        
        return view('dashboard.organizer', [
            'stats' => $stats
        ]);
    })->name('organizer.dashboard');
    
    // Events Management
    Route::get('/events', function () {
        // Mock data for now
        $events = collect([]);
        
        return view('events.manage', [
            'events' => $events
        ]);
    })->name('organizer.events');
    
    // Event Registrations
    Route::get('/events/{event}/registrations', function ($event) {
        return view('events.registrations', [
            'event' => \App\Models\Event::find($event)
        ]);
    })->name('organizer.events.registrations');
    
    // Event Statistics
    Route::get('/events/{event}/statistics', function ($event) {
        return view('events.statistics', [
            'event' => \App\Models\Event::find($event)
        ]);
    })->name('organizer.events.statistics');
    
    // All Registrations
    Route::get('/registrations', function () {
        return view('events.all-registrations');
    })->name('organizer.registrations');
    
    // Statistics
    Route::get('/statistics', function () {
        return view('dashboard.statistics', [
            'userType' => 'organizer'
        ]);
    })->name('organizer.statistics');
    
    // Profile
    Route::get('/profile', function () {
        return view('dashboard.profile', ['userType' => 'organizer']);
    })->name('organizer.profile');
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        // Mock data for now
        $stats = [
            'totalUsers' => 250,
            'activeEvents' => 45,
            'totalRegistrations' => 680,
            'totalRevenue' => 45000,
            'newUsersPercent' => 12,
            'newEventsPercent' => 8,
            'newRegistrationsPercent' => 15,
            'revenueGrowthPercent' => 22
        ];
        
        return view('dashboard.admin', [
            'stats' => $stats
        ]);
    })->name('admin.dashboard');
    
    // Users Management
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
    
    // Events Management
    Route::get('/events', function () {
        return view('admin.events');
    })->name('admin.events');
    
    // Registrations Management
    Route::get('/registrations', function () {
        return view('admin.registrations');
    })->name('admin.registrations');
    
    // Statistics
    Route::get('/statistics', function () {
        return view('dashboard.statistics', [
            'userType' => 'admin'
        ]);
    })->name('admin.statistics');
    
    // Settings
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
});

// Generic dashboard route that redirects to the specific dashboard based on role
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Auth routes
require __DIR__.'/auth.php';
