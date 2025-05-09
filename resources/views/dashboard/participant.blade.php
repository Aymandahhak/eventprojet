@extends('layouts.participant')

@section('dashboard-title', 'Mon Tableau de Bord')

@section('dashboard-content')
<!-- Statistics Cards -->
<div class="row g-4 dashboard-stats mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Mes Événements</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalRegistrations'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <a href="{{ route('participant.events') }}" class="text-decoration-none">Voir tous <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">À Venir</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['upcomingEvents'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <span class="text-muted">Prochain événement dans {{ $stats['daysToNextEvent'] ?? 0 }} jours</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Billets</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalTickets'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <a href="{{ route('participant.tickets') }}" class="text-decoration-none">Voir billets <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Notifications</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalNotifications'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <a href="#notifications" class="text-decoration-none">Voir notifications <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page d'accueil / Découverte d'événements -->
<div class="card mb-5">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Découverte d'événements</h5>
            <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-primary">Voir tous les événements</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-4">
            @forelse($recommendedEvents ?? [] as $event)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    @if($event->image)
                        <img src="{{ asset('asset/img/' . $event->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $event->title }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <i class="fas fa-calendar-day fa-3x text-primary"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="badge bg-primary rounded-pill px-3 py-2">{{ $event->category }}</div>
                            <div class="badge bg-dark rounded-pill px-3 py-2 ms-auto">{{ $event->type }}</div>
                        </div>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-calendar-alt text-primary me-2"></i>
                            <small>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <small>{{ $event->location }}</small>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-users text-primary me-2"></i>
                            <small>{{ $event->registrations->count() }}/{{ $event->capacity }}</small>
                            <div class="ms-auto">
                                <strong class="text-primary">{{ number_format($event->price, 2) }} €</strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0">
                        <a href="{{ route('events.show', $event) }}" class="btn btn-primary rounded-pill w-100">Voir détails</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucun événement recommandé trouvé</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill mt-2">Parcourir tous les événements</a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Historique des inscriptions -->
<div class="card mb-5">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Historique des inscriptions</h5>
            <a href="{{ route('participant.events') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($upcomingEvents ?? [] as $registration)
            <div class="list-group-item px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 mb-3 mb-md-0">
                        @if($registration->event->image)
                            <img src="{{ asset('asset/img/' . $registration->event->image) }}" class="img-fluid rounded" style="height: 80px; object-fit: cover;" alt="{{ $registration->event->title }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                <i class="fas fa-calendar-day fa-3x text-primary"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <h5 class="mb-1">{{ $registration->event->title }}</h5>
                        <p class="mb-1 text-muted">
                            <i class="far fa-calendar-alt text-primary me-2"></i>
                            {{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }} à 
                            {{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}
                        </p>
                        <p class="mb-1 text-muted"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $registration->event->location }}</p>
                        <p class="mb-0">
                            <span class="badge bg-{{ $registration->status == 'confirmed' ? 'success' : ($registration->status == 'pending' ? 'warning' : 'danger') }} rounded-pill">
                                {{ ucfirst($registration->status) }}
                            </span>
                            <span class="badge bg-{{ $registration->payment_status == 'paid' ? 'success' : 'warning' }} rounded-pill ms-2">
                                {{ ucfirst($registration->payment_status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('events.show', $registration->event) }}" class="btn btn-outline-primary rounded-pill mb-2 w-100">
                            <i class="fas fa-info-circle me-2"></i>Détails
                        </a>
                        <a href="{{ route('participant.tickets.download', $registration) }}" class="btn btn-primary rounded-pill d-block w-100">
                            <i class="fas fa-download me-2"></i>Télécharger Billet
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="list-group-item px-4 py-5 text-center">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <p class="mb-0 text-muted">Vous n'êtes inscrit à aucun événement</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill mt-3">Parcourir les événements</a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Mon Compte -->
<div class="card mb-5">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Mon Compte</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xl mx-auto mb-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="fas fa-user fa-3x"></i>
                        </div>
                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                        <p class="mb-3 text-muted">{{ Auth::user()->email }}</p>
                        <a href="{{ route('profile') }}" class="btn btn-primary rounded-pill w-100">
                            <i class="fas fa-user-edit me-2"></i>Modifier Profil
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-4">Informations personnelles</h5>
                        <div class="mb-3">
                            <label class="form-label text-muted">Nom complet</label>
                            <p class="fw-bold">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <p class="fw-bold">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Rôle</label>
                            <p class="fw-bold">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Membre depuis</label>
                            <p class="fw-bold">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('profile') }}" class="btn btn-primary rounded-pill">
                                <i class="fas fa-user-edit me-2"></i>Modifier Informations
                            </a>
                            <a href="{{ route('profile') }}#password" class="btn btn-outline-primary rounded-pill">
                                <i class="fas fa-key me-2"></i>Changer mot de passe
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notifications -->
<div class="card mb-5" id="notifications">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Notifications</h5>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($notifications ?? [] as $notification)
            <div class="list-group-item px-4 py-3">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle 
                            @if($notification->type == 'confirmation')
                                bg-success
                            @elseif($notification->type == 'reminder')
                                bg-warning
                            @elseif($notification->type == 'cancellation')
                                bg-danger
                            @else
                                bg-info
                            @endif
                            text-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-{{ 
                                $notification->type == 'confirmation' ? 'check-circle' : 
                                ($notification->type == 'reminder' ? 'clock' : 
                                ($notification->type == 'cancellation' ? 'times-circle' : 'bell')) 
                            }}"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <p class="mb-1 fw-bold">{{ $notification->title }}</p>
                        <p class="mb-1 small">{{ $notification->message }}</p>
                        <p class="mb-0 small text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                    </div>
                    <div class="ms-auto align-self-center">
                        <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="list-group-item px-4 py-5 text-center">
                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                <p class="mb-0 text-muted">Vous n'avez pas de notifications</p>
            </div>
            @endforelse
        </div>
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