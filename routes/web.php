<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserModifyController; 
use App\Http\Controllers\EventAdminController;
use App\Http\Controllers\RegistrationadminController;
use App\Http\Controllers\StatisticController;





// Public routes
Route::get('/', function () {
    return view('index');
});

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

// Event search route
Route::get('/events/search', [App\Http\Controllers\EventController::class, 'search'])->name('events.search');

// Authentication routes
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // Event routes
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::middleware(['can:manage-events'])->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });

    // Registration routes
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->name('registrations.show');
    Route::put('/registrations/{registration}/cancel', [RegistrationController::class, 'cancel'])->name('registrations.cancel');

    // Payment routes
    Route::get('/payments/{registration}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payments/{registration}/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payments/{registration}/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payments/{registration}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    // Role-specific routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
        // Route::get('/events', [DashboardController::class, 'events'])->name('events');
        // Route::get('/statistics', [DashboardController::class, 'statistics'])->name('statistics');
        Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
            // Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations');
                // Routes pour modifier, supprimer, bannir, etc. {users}
            Route::get('/users/edit/{id}', [UserModifyController::class, 'edit'])->name('users.edit');
            Route::put('/users/update/{id}', [UserModifyController::class, 'update'])->name('users.update');
            Route::delete('/users/delete/{id}', [UserModifyController::class, 'destroy'])->name('users.delete');
            Route::post('/users/ban/{id}', [UserModifyController::class, 'ban'])->name('users.ban');
            Route::post('/users/unban/{id}', [UserModifyController::class, 'unban'])->name('users.unban');
            //event
            Route::get('/events', [EventAdminController::class, 'index'])->name('events.index');

            Route::post('/events/publish/{id}', [EventAdminController::class, 'publish'])->name('events.publish');
            Route::post('/events/unpublish/{id}', [EventAdminController::class, 'unpublish'])->name('events.unpublish');
            Route::delete('/events/delete/{id}', [EventAdminController::class, 'destroy'])->name('events.delete');
            // registration
                Route::get('/registrations', [RegistrationadminController::class, 'index'])->name('admin.registrations.index');
                Route::post('/registrations/{id}/validate', [RegistrationadminController::class, 'validateRegistration'])->name('registrations.validate');
                Route::post('/registrations/{id}/deactivate', [RegistrationadminController::class, 'deactivateRegistration'])->name('registrations.deactivate');
                Route::delete('/registrations/{id}', [RegistrationadminController::class, 'destroy'])->name('registrations.destroy');
                Route::get('/registrations', [RegistrationadminController::class, 'index'])->name('registrations.index');
                Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');

    });

    Route::middleware(['role:organizer'])->prefix('organizer')->name('organizer.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'organizer'])->name('dashboard');
        Route::get('/events', [EventController::class, 'organizerEvents'])->name('events');
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::get('/registrations/{event}', [RegistrationController::class, 'organizerRegistrations'])->name('registrations');
    });

    Route::middleware(['role:participant'])->prefix('participant')->name('participant.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'participant'])->name('dashboard');
        Route::get('/events', [EventController::class, 'participantEvents'])->name('events');
        Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets');
        Route::get('/tickets/{registration}/download', [App\Http\Controllers\TicketController::class, 'download'])->name('tickets.download');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
