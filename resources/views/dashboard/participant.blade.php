@extends('layouts.participant')

@section('title', 'Participant Dashboard - Eventify')

@section('dashboard-content')

{{-- Statistics Cards --}}
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-purple-soft rounded-circle me-3">
                        <i class="fas fa-calendar-alt text-purple"></i>
                    </div>
                    <div>
                        <h6 class="small text-uppercase mb-1">Upcoming Events</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['upcoming_events_count'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="progress progress-sm bg-purple-soft">
                    <div class="progress-bar bg-purple" style="width: {{ min(($stats['upcoming_events_count'] ?? 0) * 10, 100) }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-success-soft rounded-circle me-3">
                        <i class="fas fa-ticket-alt text-success"></i>
                    </div>
                    <div>
                        <h6 class="small text-uppercase mb-1">My Tickets</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['tickets_count'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="progress progress-sm bg-success-soft">
                    <div class="progress-bar bg-success" style="width: {{ min(($stats['tickets_count'] ?? 0) * 10, 100) }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-info-soft rounded-circle me-3">
                        <i class="fas fa-check-circle text-info"></i>
                    </div>
                    <div>
                        <h6 class="small text-uppercase mb-1">Attended Events</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['past_events_count'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="progress progress-sm bg-info-soft">
                    <div class="progress-bar bg-info" style="width: {{ min(($stats['past_events_count'] ?? 0) * 10, 100) }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-warning-soft rounded-circle me-3">
                        <i class="fas fa-bell text-warning"></i>
                    </div>
                    <div>
                        <h6 class="small text-uppercase mb-1">Notifications</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['notifications_count'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="progress progress-sm bg-warning-soft">
                    <div class="progress-bar bg-warning" style="width: {{ min(($stats['notifications_count'] ?? 0) * 20, 100) }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Découverte d'événements -->
<div class="card content-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="fas fa-compass me-2 text-purple"></i> Découverte d'événements
        </h5>
        <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-purple">
            Voir tous <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="row g-4">
            @forelse($recommendedEvents ?? [] as $event)
            <div class="col-lg-4 col-md-6">
                <div class="event-card h-100">
                    <div class="event-image position-relative">
                        @if($event->image)
                            <img src="{{ asset('asset/img/' . $event->image) }}" alt="{{ $event->title }}" class="event-img">
                        @else
                            <div class="event-img-placeholder">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        @endif
                        <div class="event-badges">
                            <span class="badge bg-purple-soft text-purple">{{ $event->category }}</span>
                            <span class="badge bg-dark-soft text-light">{{ $event->type }}</span>
                        </div>
                    </div>
                    <div class="event-content">
                        <h5 class="event-title">{{ $event->title }}</h5>
                        <div class="event-info">
                            <div class="event-info-item">
                                <i class="fas fa-calendar-alt text-purple"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                            </div>
                            <div class="event-info-item">
                                <i class="fas fa-map-marker-alt text-purple"></i>
                                {{ Str::limit($event->location, 30) }}
                            </div>
                            <div class="event-info-item">
                                <i class="fas fa-users text-purple"></i>
                                {{ $event->registrations->count() }}/{{ $event->capacity }} Participants
                            </div>
                        </div>
                        <div class="event-footer">
                            <span class="event-price">{{ number_format($event->price, 2) }} €</span>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-gradient">
                                Détails <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-search fa-3x text-purple mb-3"></i>
                    <p class="mb-3">Aucun événement recommandé trouvé pour le moment.</p>
                    <a href="{{ route('events.index') }}" class="btn btn-gradient">
                        <i class="fas fa-compass me-2"></i> Parcourir les événements
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Historique des inscriptions -->
<div class="card content-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="fas fa-history text-purple me-2"></i>
            <h5 class="card-title mb-0">Historique des inscriptions</h5>
        </div>
        <a href="{{ route('participant.events') }}" class="btn btn-sm btn-outline-purple">
            Voir tout <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <div class="list-group registration-list">
            @forelse($upcomingEvents ?? [] as $registration)
            <div class="list-group-item registration-item">
                <div class="row align-items-center g-3">
                    <div class="col-auto">
                        <div class="registration-image">
                            @if($registration->event->image)
                                <img src="{{ asset('asset/img/' . $registration->event->image) }}" alt="{{ $registration->event->title }}">
                            @else
                                <div class="registration-img-placeholder">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col registration-info">
                        <h6 class="registration-title">{{ $registration->event->title }}</h6>
                        <div class="registration-meta">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt text-purple"></i>
                                {{ \Carbon\Carbon::parse($registration->event->start_date)->format('d M Y, H:i') }}
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt text-purple"></i>
                                {{ Str::limit($registration->event->location, 40) }}
                            </div>
                        </div>
                        <div class="registration-status">
                            <span class="badge rounded-pill {{ 
                                ($registration->status == 'confirmed') ? 'bg-success-soft text-success' : 
                                (($registration->status == 'pending') ? 'bg-warning-soft text-warning' : 
                                (($registration->status == 'cancelled') ? 'bg-danger-soft text-danger' : 'bg-secondary-soft text-light')) 
                            }}">{{ ucfirst($registration->status) }}</span>
                            <span class="badge rounded-pill {{ 
                                ($registration->payment_status == 'paid') ? 'bg-success-soft text-success' : 
                                (($registration->payment_status == 'pending') ? 'bg-warning-soft text-warning' : 
                                (($registration->payment_status == 'refunded') ? 'bg-info-soft text-info' : 'bg-secondary-soft text-light')) 
                            }}">{{ ucfirst($registration->payment_status) }}</span>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="registration-actions">
                            <a href="{{ route('events.show', $registration->event) }}" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-info-circle me-1"></i> Détails
                            </a>
                            @if($registration->status == 'confirmed' && $registration->payment_status == 'paid')
                            <a href="{{ route('participant.tickets.download', $registration) }}" class="btn btn-sm btn-gradient">
                                <i class="fas fa-download me-1"></i> Billet
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-calendar-times fa-3x text-purple mb-3"></i>
                <p class="mb-3">Vous n'êtes inscrit à aucun événement.</p>
                <a href="{{ route('events.index') }}" class="btn btn-gradient">
                    <i class="fas fa-compass me-2"></i> Parcourir les événements
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Mon Compte & Notifications -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-user-circle text-purple me-2"></i>
                <h5 class="card-title mb-0">Mon Compte</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="profile-img-wrapper mx-auto mb-3">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('asset/img/default-avatar.png') }}" alt="{{ Auth::user()->name }}" class="profile-img">
                    </div>
                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>
                <ul class="account-info">
                    <li class="account-info-item">
                        <div class="info-label">Nom complet:</div>
                        <div class="info-value">{{ Auth::user()->name }}</div>
                    </li>
                    <li class="account-info-item">
                        <div class="info-label">Email:</div>
                        <div class="info-value">{{ Auth::user()->email }}</div>
                    </li>
                    <li class="account-info-item">
                        <div class="info-label">Rôle:</div>
                        <div class="info-value">{{ ucfirst(Auth::user()->role) }}</div>
                    </li>
                    <li class="account-info-item">
                        <div class="info-label">Membre depuis:</div>
                        <div class="info-value">{{ Auth::user()->created_at->format('d M Y') }}</div>
                    </li>
                </ul>
                <div class="text-center mt-4">
                    <a href="{{ route('participant.profile') }}" class="btn btn-outline-purple">
                        <i class="fas fa-user-edit me-2"></i> Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-bell text-purple me-2"></i>
                <h5 class="card-title mb-0">Notifications récentes</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group notification-list">
                    @forelse($notifications ?? [] as $notification)
                    <div class="list-group-item notification-item {{ $notification->is_read ? '' : 'unread' }}">
                        <div class="notification-icon">
                            <i class="fas {{ $notification->icon ?? 'fa-bell' }} text-purple"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-text mb-1">{{ $notification->message }}</p>
                            <small class="notification-time text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        @if(!$notification->is_read)
                        <div class="notification-actions">
                            <form action="{{ route('participant.notifications.mark-as-read', $notification) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-light-purple">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="fas fa-bell-slash fa-3x text-purple mb-3"></i>
                        <p class="mb-3">Aucune notification pour le moment.</p>
                    </div>
                    @endforelse
                </div>
                
                @if(!empty($notifications) && count($notifications) > 0)
                <div class="notification-footer p-3 text-center">
                    <a href="{{ route('participant.notifications') }}" class="btn btn-sm btn-outline-purple w-100">
                        Voir toutes les notifications <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($calendarEvents ?? false) {{-- Only show calendar if events are passed --}}
<div class="content-card card mt-4 mb-5">
    <div class="card-header bg-transparent px-4 py-3">
        <h5 class="mb-0 section-title-underline"><span>Mon Calendrier d'Événements</span></h5>
    </div>
    <div class="card-body p-3 p-md-4">
        <div id="calendar" style="min-height: 450px;"></div>
    </div>
</div>
@endif

@endsection

@push('styles_before')
<style>
    /* Minimal styles for feather icons */
    .feather-xs {
        width: 0.8rem;
        height: 0.8rem;
        vertical-align: middle;
    }
    
    /* Dark theme styles for FullCalendar */
    .fc-theme-standard .fc-scrollgrid {
        border-color: rgba(255, 255, 255, 0.05);
    }
    
    .fc-theme-standard td, .fc-theme-standard th {
        border-color: rgba(255, 255, 255, 0.05);
    }
    
    .fc-theme-standard .fc-list-day-cushion {
        background-color: rgba(30, 41, 59, 0.6);
    }
    
    .fc-theme-standard .fc-list-event:hover td {
        background-color: rgba(107, 70, 193, 0.1);
    }
    
    .fc .fc-button-primary {
        background-color: #6B46C1;
        border-color: #6B46C1;
    }
    
    .fc .fc-button-primary:hover {
        background-color: #5A32AB;
        border-color: #5A32AB;
    }
    
    .fc .fc-daygrid-day.fc-day-today {
        background-color: rgba(107, 70, 193, 0.1);
    }
</style>
@endpush

@push('styles')
<style>
    /* Stat Cards */
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .bg-purple-soft {
        background-color: rgba(107, 70, 193, 0.15) !important;
    }
    
    .text-purple {
        color: #6B46C1 !important;
    }
    
    .bg-purple {
        background-color: #6B46C1 !important;
    }
    
    .progress-sm {
        height: 4px;
        border-radius: 2px;
    }
    
    .bg-dark-soft {
        background-color: rgba(30, 41, 59, 0.6) !important;
    }
    
    /* Event Cards */
    .event-card {
        background: rgba(30, 41, 59, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
        overflow: hidden;
    }
    
    .event-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 35px rgba(107, 70, 193, 0.25);
        border-color: rgba(107, 70, 193, 0.3);
    }
    
    .event-image {
        position: relative;
        height: 180px;
        overflow: hidden;
    }
    
    .event-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .event-card:hover .event-img {
        transform: scale(1.1);
    }
    
    .event-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(30, 41, 59, 0.8);
        color: #94A3B8;
        font-size: 3rem;
    }
    
    .event-badges {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        gap: 5px;
    }
    
    .event-content {
        padding: 1.25rem;
    }
    
    .event-title {
        margin-bottom: 1rem;
        font-weight: 600;
        font-size: 1.1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .event-info {
        margin-bottom: 1.25rem;
    }
    
    .event-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: #94A3B8;
        font-size: 0.9rem;
    }
    
    .event-info-item i {
        width: 18px;
        margin-right: 0.5rem;
    }
    
    .event-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 1rem;
    }
    
    .event-price {
        font-weight: 700;
        font-size: 1.25rem;
        color: #6B46C1;
    }
    
    .btn-outline-purple {
        color: #6B46C1;
        border-color: #6B46C1;
        background-color: transparent;
    }
    
    .btn-outline-purple:hover {
        color: #fff;
        background-color: #6B46C1;
        border-color: #6B46C1;
    }
    
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem;
        background-color: rgba(30, 41, 59, 0.3);
        border-radius: 1rem;
    }

    /* Registration Items */
    .registration-list {
        border-radius: 0 0 1rem 1rem;
        overflow: hidden;
    }
    
    .registration-item {
        padding: 1rem 1.5rem;
        background-color: transparent;
        border-color: rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }
    
    .registration-item:hover {
        background-color: rgba(30, 41, 59, 0.3);
    }
    
    .registration-image {
        width: 80px;
        height: 60px;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .registration-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .registration-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(30, 41, 59, 0.8);
        color: #94A3B8;
        font-size: 1.5rem;
    }
    
    .registration-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .registration-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 0.5rem;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        color: var(--text-muted);
        font-size: 0.85rem;
    }
    
    .meta-item i {
        margin-right: 0.5rem;
        font-size: 0.85rem;
    }
    
    .registration-status {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .registration-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    /* Account Info */
    .profile-img-wrapper {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        padding: 3px;
        background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
    }
    
    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid var(--primary-light);
    }
    
    .account-info {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem;
    }
    
    .account-info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.05);
    }
    
    .account-info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        color: var(--text-muted);
    }
    
    .info-value {
        font-weight: 500;
    }
    
    /* Notifications */
    .notifications-list {
        max-height: 400px;
        overflow-y: auto;
    }
    
    .notification-item {
        display: flex;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }
    
    .notification-item:last-child {
        border-bottom: none;
    }
    
    .notification-item:hover {
        background-color: rgba(30, 41, 59, 0.3);
    }
    
    .notification-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 1rem;
    }
    
    .notification-content {
        flex-grow: 1;
    }
    
    .notification-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }
    
    .notification-message {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .notification-meta {
        display: flex;
        align-items: center;
    }
    
    .notification-time {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    
    .notification-actions {
        margin-left: 1rem;
    }
    
    @media (max-width: 767.98px) {
        .registration-meta {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .registration-actions {
            margin-top: 1rem;
            flex-direction: column;
            width: 100%;
        }
        
        .registration-actions .btn {
            width: 100%;
        }
        
        .notification-item {
            flex-direction: column;
        }
        
        .notification-icon {
            margin-bottom: 1rem;
            margin-right: 0;
        }
        
        .notification-actions {
            margin-top: 1rem;
            margin-left: 0;
            align-self: flex-end;
        }
    }
</style>
@endpush

@push('scripts_footer')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
        @if($calendarEvents ?? false)
        if (calendarEl) { 
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: [
                    @foreach($calendarEvents ?? [] as $event)
                    {
                        title: '{{ addslashes($event->title) }}',
                        start: '{{ $event->date->format('Y-m-d') . (isset($event->time) ? "T" . $event->time : "") }}',
                        url: '{{ route('events.show', $event) }}',
                        backgroundColor: '{{ $event->status == "confirmed" ? "#6B46C1" : ($event->status == "cancelled" ? "#DC2626" : "#F59E0B") }}',
                        borderColor: '{{ $event->status == "confirmed" ? "#6B46C1" : ($event->status == "cancelled" ? "#DC2626" : "#F59E0B") }}',
                        textColor: '#fff'
                    },
                    @endforeach
                ],
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault(); 
                    }
                },
                height: 'auto',
                themeSystem: 'bootstrap5',
                dayMaxEvents: true, 
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week:  'Week',
                    list:  'List'
                }
            });
            calendar.render();
        }
        @endif

        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endpush 
