<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Registration;
use App\Policies\EventPolicy;
use App\Policies\RegistrationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
        Registration::class => RegistrationPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('manage-events', function ($user) {
            return $user->isAdmin() || $user->isOrganizer();
        });

        Gate::define('view-registrations', function ($user) {
            return $user->isAdmin() || $user->isOrganizer();
        });
    }
} 