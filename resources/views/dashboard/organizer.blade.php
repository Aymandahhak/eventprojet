@extends('layouts.organizer')

@section('dashboard-title', 'Organizer Dashboard')

@section('dashboard-content')
<!-- Welcome Section -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="rounded-circle" width="100" height="100" alt="Profile Photo">
                @else
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                @endif
            </div>
            <div class="ms-4">
                <h2 class="mb-1">Welcome back, {{ auth()->user()->name }}!</h2>
                <p class="text-muted mb-0">Here's what's happening with your events today.</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards Row -->
<div class="row g-4 mb-4">
    <!-- Total Events Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Events</h6>
                        <h4 class="mb-0">{{ $stats['totalEvents'] ?? 0 }}</h4>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>
                            {{ $stats['newEventsPercent'] ?? 0 }}% this month
                        </small>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-calendar-alt text-primary fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Events Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Active Events</h6>
                        <h4 class="mb-0">{{ $stats['upcomingEvents'] ?? 0 }}</h4>
                        <small class="text-muted">Currently running</small>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-calendar-check text-success fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Participants Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Participants</h6>
                        <h4 class="mb-0">{{ $stats['totalParticipants'] ?? 0 }}</h4>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>
                            {{ $stats['newParticipantsPercent'] ?? 0 }}% increase
                        </small>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-users text-info fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Revenue</h6>
                        <h4 class="mb-0">{{ number_format($stats['totalRevenue'] ?? 0) }} DH</h4>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>
                            {{ $stats['revenueGrowthPercent'] ?? 0 }}% growth
                        </small>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-money-bill-wave text-warning fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions and Events Section -->
<div class="row g-4">
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create New Event
                    </a>
                    <a href="{{ route('organizer.registrations.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-ticket-alt me-2"></i>Manage Registrations
                    </a>
                    <a href="{{ route('organizer.statistics') }}" class="btn btn-outline-primary">
                        <i class="fas fa-chart-line me-2"></i>View Analytics
                    </a>
                    <a href="{{ route('organizer.profile') }}" class="btn btn-outline-primary">
                        <i class="fas fa-user-cog me-2"></i>Update Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Upcoming Events</h5>
                <a href="{{ route('organizer.events') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Event</th>
                                <th class="border-0">Date</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Registrations</th>
                                <th class="border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcomingEvents ?? [] as $event)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}" class="rounded me-3" width="48" alt="{{ $event->title }}">
                                        @else
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <i class="fas fa-calendar-day text-primary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $event->title }}</h6>
                                            <small class="text-muted">{{ $event->location }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $event->start_date->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $event->is_published ? 'success' : 'warning' }}">
                                        {{ $event->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td>{{ $event->registrations_count ?? 0 }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                        <p class="mb-2">No upcoming events found</p>
                                        <a href="{{ route('events.create') }}" class="btn btn-sm btn-primary">
                                            Create Your First Event
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Activity</h5>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Filter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All Activity</a></li>
                <li><a class="dropdown-item" href="#">Registrations</a></li>
                <li><a class="dropdown-item" href="#">Event Updates</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($recentActivities ?? [] as $activity)
            <div class="list-group-item border-0 py-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-{{ $activity->type === 'registration' ? 'success' : 'primary' }} bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-{{ $activity->type === 'registration' ? 'ticket-alt' : 'calendar-alt' }} text-{{ $activity->type === 'registration' ? 'success' : 'primary' }}"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">{{ $activity->title }}</h6>
                        <p class="text-muted small mb-0">{{ $activity->description }}</p>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <p class="text-muted mb-0">No recent activity</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.card {
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-5px);
}
.bg-opacity-10 {
    --bs-bg-opacity: 0.1;
}
.table > :not(caption) > * > * {
    padding: 1rem;
}
</style>
@endpush