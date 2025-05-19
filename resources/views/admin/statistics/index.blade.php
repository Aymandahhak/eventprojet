@extends('layouts.admin')

@section('dashboard-title', 'Admin Statistics')

@section('dashboard-content')
<div class="container-fluid px-4 py-5">
    <!-- Main Stats Cards -->
    <div class="row g-4 dashboard-stats mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100 bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="stat-icon">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="stat-change">
                            <span class="badge bg-light text-primary">
                                <i class="fas fa-arrow-up me-1"></i>{{ $newUsersPercent ?? 0 }}%
                            </span>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Total Users</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ number_format($totalUsers) }}</h2>
                    <p class="small text-white-50 mt-2 mb-0">
                        <i class="fas fa-clock me-1"></i> Since last month
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100 bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                        <div class="stat-change">
                            <span class="badge bg-light text-success">
                                <i class="fas fa-arrow-up me-1"></i>{{ $newEventsPercent ?? 0 }}%
                            </span>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Published Events</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ number_format($publishedEvents) }}</h2>
                    <p class="small text-white-50 mt-2 mb-0">
                        <i class="fas fa-clock me-1"></i> Since last month
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100 bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="stat-icon">
                            <i class="fas fa-ticket-alt fa-2x"></i>
                        </div>
                        <div class="stat-change">
                            <span class="badge bg-light text-info">
                                <i class="fas fa-arrow-up me-1"></i>{{ $newRegistrationsPercent ?? 0 }}%
                            </span>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Registrations</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ number_format($totalRegistrations) }}</h2>
                    <p class="small text-white-50 mt-2 mb-0">
                        <i class="fas fa-clock me-1"></i> Since last month
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100 bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="stat-icon">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                        <div class="stat-change">
                            <span class="badge bg-light text-warning">
                                <i class="fas fa-arrow-up me-1"></i>{{ $revenueGrowthPercent ?? 0 }}%
                            </span>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Revenue</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ number_format($totalRevenue) }} DH</h2>
                    <p class="small text-white-50 mt-2 mb-0">
                        <i class="fas fa-clock me-1"></i> Since last month
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribution Cards -->
    <div class="row g-4 mb-5">
        <!-- User Roles Distribution -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">
                        <i class="fas fa-user-tag me-2 text-primary"></i>
                        User Roles Distribution
                    </h5>
        </div>
        <div class="card-body">
                    <div class="list-group list-group-flush">
                @foreach($userRoles as $role => $count)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="role-name">
                                    <i class="fas fa-circle me-2 text-primary"></i>
                                    {{ ucfirst($role) }}
                                </span>
                                <span class="badge bg-primary rounded-pill">{{ $count }} users</span>
                            </div>
                @endforeach
                    </div>
        </div>
        </div>
    </div>

        <!-- Event Types Distribution -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2 text-success"></i>
                        Event Types Distribution
                    </h5>
        </div>
        <div class="card-body">
                    <div class="list-group list-group-flush">
                @foreach($eventTypes as $type => $count)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="type-name">
                                    <i class="fas fa-circle me-2 text-success"></i>
                                    {{ ucfirst($type) }}
                                </span>
                                <span class="badge bg-success rounded-pill">{{ $count }} events</span>
                            </div>
                @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Registrations -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0">
            <h5 class="mb-0">
                <i class="fas fa-chart-line me-2 text-info"></i>
                Monthly Registrations Trend
            </h5>
        </div>
        <div class="card-body">
            <div class="list-group list-group-flush">
                @foreach($monthlyRegistrations as $registration)
                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="month-name">
                            <i class="fas fa-calendar-alt me-2 text-info"></i>
                            {{ $registration->month }}
                        </span>
                        <span class="badge bg-info rounded-pill">{{ $registration->total }} registrations</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a 0%, #13855c 100%);
}

.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc 0%, #258391 100%);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f6c23e 0%, #dda20a 100%);
}

.stat-card {
    transition: transform 0.2s ease-in-out;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    opacity: 0.8;
}

.card {
    border-radius: 0.75rem;
    transition: all 0.2s ease;
}

.card:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.card-header {
    padding: 1.25rem;
}

.badge {
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
}

.list-group-item {
    border-left: 0;
    border-right: 0;
    padding: 1rem 0;
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.role-name, .type-name, .month-name {
    font-weight: 500;
}

.badge.rounded-pill {
    font-weight: 500;
    font-size: 0.875rem;
}
</style>
@endsection
