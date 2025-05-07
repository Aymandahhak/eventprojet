@extends('layouts.organizer')

@section('dashboard-title', 'Organizer Overview')

@section('dashboard-content')
<!-- Statistics Cards -->
<div class="row g-4 dashboard-stats mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">My Events</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalEvents'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $stats['newEventsPercent'] ?? 0 }}%</span> since last month
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Participants</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalParticipants'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $stats['newParticipantsPercent'] ?? 0 }}%</span> since last month
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Upcoming Events</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['upcomingEvents'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    Next event in {{ $stats['daysToNextEvent'] ?? 0 }} days
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Revenue</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalRevenue'] ?? 0 }} DH</h2>
                    </div>
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $stats['revenueGrowthPercent'] ?? 0 }}%</span> since last month
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card mb-5">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Quick Actions</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('events.create') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <div class="btn btn-primary rounded-circle mb-3">
                                <i class="fas fa-plus fa-2x"></i>
                            </div>
                            <h5>Create Event</h5>
                            <p class="text-muted mb-0">Create a new event and start selling tickets</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('organizer.registrations') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <div class="btn btn-success rounded-circle mb-3">
                                <i class="fas fa-ticket-alt fa-2x"></i>
                            </div>
                            <h5>Manage Registrations</h5>
                            <p class="text-muted mb-0">View and manage event registrations</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('organizer.statistics') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <div class="btn btn-info rounded-circle mb-3">
                                <i class="fas fa-chart-bar fa-2x"></i>
                            </div>
                            <h5>View Statistics</h5>
                            <p class="text-muted mb-0">Analyze your events performance</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Events and Recent Registrations -->
<div class="row g-4">
    <!-- Upcoming Events -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Upcoming Events</h5>
                    <a href="{{ route('organizer.events') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($upcomingEvents ?? [] as $event)
                    <div class="list-group-item px-4 py-3">
                        <div class="d-flex align-items-center">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="rounded" style="width: 70px; height: 70px; object-fit: cover;" alt="{{ $event->title }}">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                    <i class="fas fa-calendar-day fa-2x text-primary"></i>
                                </div>
                            @endif
                            <div class="ms-3 flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0">{{ $event->title }}</h6>
                                    <span class="badge bg-{{ $event->is_published ? 'success' : 'warning' }}">{{ $event->is_published ? 'Published' : 'Draft' }}</span>
                                </div>
                                <p class="mb-0 small"><i class="far fa-calendar-alt text-primary me-2"></i>{{ $event->date->format('F d, Y') }} at {{ $event->time }}</p>
                                <p class="mb-0 small"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $event->location }}</p>
                            </div>
                            <div class="ms-3">
                                <div class="d-flex flex-column align-items-end">
                                    <span class="badge bg-primary mb-2">{{ $event->registrations_count ?? 0 }} registrations</span>
                                    <div>
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item px-4 py-5 text-center">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <p class="mb-0 text-muted">No upcoming events</p>
                        <a href="{{ route('events.create') }}" class="btn btn-primary rounded-pill mt-3">Create New Event</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Registrations -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Registrations</h5>
                    <a href="{{ route('organizer.registrations') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentRegistrations ?? [] as $registration)
                    <div class="list-group-item px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $registration->user->name }}</h6>
                                <p class="mb-0 small text-muted">{{ $registration->event->title }}</p>
                                <p class="mb-0 small text-muted">{{ $registration->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $registration->status == 'confirmed' ? 'success' : ($registration->status == 'pending' ? 'warning' : 'danger') }} mb-2">{{ ucfirst($registration->status) }}</span>
                                <div>
                                    <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item px-4 py-5 text-center">
                        <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                        <p class="mb-0 text-muted">No recent registrations</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Trend Chart -->
<div class="card mt-5">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Registration Trends</h5>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="chartPeriodDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Last 30 Days
                </button>
                <ul class="dropdown-menu" aria-labelledby="chartPeriodDropdown">
                    <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 90 Days</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="registrationChart" style="height: 300px;"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Registration Trend Chart
        const ctx = document.getElementById('registrationChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [
                    {
                        label: 'Tech Innovation Summit',
                        data: [12, 19, 28, 35],
                        backgroundColor: 'rgba(13, 110, 253, 0.5)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Creative Workshop',
                        data: [8, 12, 18, 24],
                        backgroundColor: 'rgba(25, 135, 84, 0.5)',
                        borderColor: 'rgba(25, 135, 84, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Business Seminar',
                        data: [5, 15, 22, 30],
                        backgroundColor: 'rgba(13, 202, 240, 0.5)',
                        borderColor: 'rgba(13, 202, 240, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Registrations'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Time Period'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
</script>
@endsection 