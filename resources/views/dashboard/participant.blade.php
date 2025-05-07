@extends('layouts.participant')

@section('dashboard-title', 'My Dashboard')

@section('dashboard-content')
<!-- Statistics Cards -->
<div class="row g-4 dashboard-stats mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Registered Events</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalRegistrations'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <a href="{{ route('participant.registrations') }}" class="text-decoration-none">View All <i class="fas fa-arrow-right ms-1"></i></a>
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
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <span class="text-muted">Next event in {{ $stats['daysToNextEvent'] ?? 0 }} days</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Tickets</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalTickets'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <a href="{{ route('participant.tickets') }}" class="text-decoration-none">View Tickets <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Certificates</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalCertificates'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-certificate"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <a href="{{ route('participant.certificates') }}" class="text-decoration-none">View Certificates <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Events -->
<div class="card mb-5">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">My Upcoming Events</h5>
            <a href="{{ route('participant.registrations') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($upcomingEvents ?? [] as $registration)
            <div class="list-group-item px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 mb-3 mb-md-0">
                        @if($registration->event->image)
                            <img src="{{ asset('storage/' . $registration->event->image) }}" class="img-fluid rounded" alt="{{ $registration->event->title }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                <i class="fas fa-calendar-day fa-3x text-primary"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <h5 class="mb-1">{{ $registration->event->title }}</h5>
                        <p class="mb-1 text-muted"><i class="far fa-calendar-alt text-primary me-2"></i>{{ $registration->event->date->format('F d, Y') }} at {{ $registration->event->time }}</p>
                        <p class="mb-1 text-muted"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $registration->event->location }}</p>
                        <p class="mb-0">
                            <span class="badge bg-{{ $registration->status == 'confirmed' ? 'success' : ($registration->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                            <span class="badge bg-{{ $registration->payment_status == 'paid' ? 'success' : 'warning' }} ms-2">
                                {{ ucfirst($registration->payment_status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('events.show', $registration->event) }}" class="btn btn-primary rounded-pill mb-2">View Details</a>
                        <a href="{{ route('participant.tickets.download', $registration) }}" class="btn btn-outline-secondary rounded-pill d-block">Download Ticket</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="list-group-item px-4 py-5 text-center">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <p class="mb-0 text-muted">You're not registered for any upcoming events</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill mt-3">Browse Events</a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Recommended Events and Recent Activity -->
<div class="row g-4">
    <!-- Recommended Events -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Recommended For You</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    @forelse($recommendedEvents ?? [] as $event)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                    <i class="fas fa-calendar-day fa-3x text-primary"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="btn btn-sm btn-primary px-3 rounded-pill">{{ $event->category }}</div>
                                    <div class="ms-auto text-muted"><i class="far fa-calendar-alt me-1"></i>{{ $event->date->format('M d, Y') }}</div>
                                </div>
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
                                <div class="d-flex align-items-center">
                                    <div><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $event->location }}</div>
                                    <div class="ms-auto">
                                        @if($event->price > 0)
                                            <i class="fas fa-ticket-alt text-primary me-2"></i>{{ $event->price }} DH
                                        @else
                                            <i class="fas fa-ticket-alt text-primary me-2"></i>Free
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-primary w-100 rounded-pill">View Details</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recommended events found based on your interests</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill mt-2">Browse All Events</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Recent Activity</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentActivities ?? [] as $activity)
                    <div class="list-group-item px-4 py-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm rounded-circle bg-{{ $activity->type == 'registration' ? 'primary' : ($activity->type == 'payment' ? 'success' : 'info') }} text-white d-flex align-items-center justify-content-center">
                                    <i class="fas fa-{{ $activity->type == 'registration' ? 'calendar-check' : ($activity->type == 'payment' ? 'credit-card' : 'ticket-alt') }}"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="mb-1 fw-bold">{{ $activity->title }}</p>
                                <p class="mb-0 small text-muted">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item px-4 py-5 text-center">
                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                        <p class="mb-0 text-muted">No recent activities</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Calendar -->
<div class="card mt-5">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">My Event Calendar</h5>
    </div>
    <div class="card-body">
        <div id="calendar" style="height: 400px;"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
        // Sample event data - would come from the backend in a real application
        const events = [
            @foreach($calendarEvents ?? [] as $event)
            {
                title: '{{ $event->title }}',
                start: '{{ $event->date->format('Y-m-d') }}T{{ $event->time }}',
                url: '{{ route('events.show', $event) }}',
                backgroundColor: '{{ $event->status == 'confirmed' ? '#0d6efd' : '#ffc107' }}'
            },
            @endforeach
        ];
        
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: events,
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    return false;
                }
            }
        });
        
        calendar.render();
    });
</script>
@endsection 