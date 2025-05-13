@extends('layouts.admin')

@section('dashboard-title', 'Admin Statistics')

@section('dashboard-content')
    <!-- Statistiques principales -->
    <div class="row g-4 dashboard-stats mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light h-100">
                <div class="card-body">
                    <h6 class="text-primary">Total Users</h6>
                    <h2 class="display-6 fw-bold">{{ $totalUsers }}</h2>
                    <div class="mt-3 small text-muted">
                        <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $newUsersPercent ?? 0 }}%</span> since last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light h-100">
                <div class="card-body">
                    <h6 class="text-primary">Published Events</h6>
                    <h2 class="display-6 fw-bold">{{ $publishedEvents }}</h2>
                    <div class="mt-3 small text-muted">
                        <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $newEventsPercent ?? 0 }}%</span> since last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light h-100">
                <div class="card-body">
                    <h6 class="text-primary">Registrations</h6>
                    <h2 class="display-6 fw-bold">{{ $totalRegistrations }}</h2>
                    <div class="mt-3 small text-muted">
                        <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $newRegistrationsPercent ?? 0 }}%</span> since last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light h-100">
                <div class="card-body">
                    <h6 class="text-primary">Revenue</h6>
                    <h2 class="display-6 fw-bold">{{ $totalRevenue }} DH</h2>
                    <div class="mt-3 small text-muted">
                        <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $revenueGrowthPercent ?? 0 }}%</span> since last month
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Répartition des rôles des utilisateurs -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>User Roles Distribution</h4>
        </div>
        <div class="card-body">
            <ul>
                @foreach($userRoles as $role => $count)
                    <li>{{ ucfirst($role) }}: {{ $count }} users</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Répartition des types d'événements -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Event Types Distribution</h4>
        </div>
        <div class="card-body">
            <ul>
                @foreach($eventTypes as $type => $count)
                    <li>{{ ucfirst($type) }}: {{ $count }} events</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Nombre d'enregistrements par mois -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Monthly Registrations</h4>
        </div>
        <div class="card-body">
            <ul>
                @foreach($monthlyRegistrations as $registration)
                    <li>{{ $registration->month }}: {{ $registration->total }} registrations</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
