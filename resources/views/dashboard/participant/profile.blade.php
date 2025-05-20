@extends('layouts.participant')

@section('title', 'Mon Profil - Eventify')

@section('profile-header')
<div class="profile-header">
    <div class="profile-cover">
        <div class="profile-avatar-wrapper">
            <img src="{{ Auth::user()->profile_photo_url ?? asset('asset/img/default-avatar.png') }}" alt="{{ Auth::user()->name }}" class="profile-avatar">
        </div>
    </div>
    <div class="profile-info-bar">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between py-3">
                <div class="profile-user-info">
                    <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                    <p class="profile-meta">
                        <span class="profile-role">{{ ucfirst(Auth::user()->role) }}</span>
                        <span class="profile-separator">•</span>
                        <span class="profile-member-since">Membre depuis {{ Auth::user()->created_at->format('M Y') }}</span>
                    </p>
                </div>
                <div class="profile-actions mt-3 mt-md-0">
                    <a href="#" class="btn btn-sm btn-gradient me-2">
                        <i class="fas fa-edit me-1"></i> Modifier le profil
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-light">
                        <i class="fas fa-cog me-1"></i> Paramètres
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dashboard-content')
<div class="row g-4">
    <div class="col-lg-4">
        <!-- Profile Details Card -->
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-user-circle text-purple me-2"></i>
                <h5 class="card-title mb-0">Informations personnelles</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush profile-details">
                    <li class="list-group-item d-flex">
                        <div class="profile-detail-icon">
                            <i class="fas fa-envelope text-purple"></i>
                        </div>
                        <div class="profile-detail-content">
                            <div class="profile-detail-label">Email</div>
                            <div class="profile-detail-value">{{ Auth::user()->email }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="profile-detail-icon">
                            <i class="fas fa-phone text-purple"></i>
                        </div>
                        <div class="profile-detail-content">
                            <div class="profile-detail-label">Téléphone</div>
                            <div class="profile-detail-value">{{ Auth::user()->phone ?? 'Non renseigné' }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="profile-detail-icon">
                            <i class="fas fa-map-marker-alt text-purple"></i>
                        </div>
                        <div class="profile-detail-content">
                            <div class="profile-detail-label">Adresse</div>
                            <div class="profile-detail-value">{{ Auth::user()->address ?? 'Non renseigné' }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="profile-detail-icon">
                            <i class="fas fa-calendar-alt text-purple"></i>
                        </div>
                        <div class="profile-detail-content">
                            <div class="profile-detail-label">Date d'inscription</div>
                            <div class="profile-detail-value">{{ Auth::user()->created_at->format('d/m/Y') }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Preferences Card -->
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-sliders-h text-purple me-2"></i>
                <h5 class="card-title mb-0">Préférences</h5>
            </div>
            <div class="card-body">
                <div class="profile-preferences">
                    <div class="preference-item">
                        <div class="preference-label">Notifications par email</div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                        </div>
                    </div>
                    <div class="preference-item">
                        <div class="preference-label">Notifications push</div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="pushNotif" checked>
                        </div>
                    </div>
                    <div class="preference-item">
                        <div class="preference-label">Newsletter</div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="newsletter">
                        </div>
                    </div>
                    <div class="preference-item">
                        <div class="preference-label">Mode sombre</div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="darkMode" checked>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <!-- Upcoming Events -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-calendar-alt text-purple me-2"></i>
                    <h5 class="card-title mb-0">Mes événements à venir</h5>
                </div>
                <span class="badge bg-purple">{{ count($upcomingEvents ?? []) }}</span>
            </div>
            <div class="card-body p-0">
                @if(count($upcomingEvents ?? []) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Événement</th>
                                <th>Date</th>
                                <th>Lieu</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingEvents ?? [] as $event)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="event-icon bg-purple-soft rounded-circle text-purple me-3">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $event->title }}</h6>
                                            <small class="text-muted">{{ $event->category }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</td>
                                <td>{{ Str::limit($event->location, 20) }}</td>
                                <td><span class="badge bg-success-soft text-success">Confirmé</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-icon" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>Voir détails</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-ticket-alt me-2"></i>Voir billet</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-times me-2"></i>Annuler</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state py-5">
                    <i class="fas fa-calendar-times fa-3x text-purple mb-3"></i>
                    <p>Vous n'avez pas d'événements à venir.</p>
                    <a href="#" class="btn btn-gradient mt-2">
                        <i class="fas fa-compass me-2"></i> Découvrir des événements
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Tickets -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-ticket-alt text-purple me-2"></i>
                    <h5 class="card-title mb-0">Mes billets</h5>
                </div>
                <span class="badge bg-purple">{{ count($tickets ?? []) }}</span>
            </div>
            <div class="card-body">
                @if(count($tickets ?? []) > 0)
                <div class="row g-3">
                    @foreach($tickets ?? [] as $ticket)
                    <div class="col-md-6">
                        <div class="ticket-card">
                            <div class="ticket-header">
                                <div class="ticket-logo">E</div>
                                <div class="ticket-event">{{ $ticket->event->title }}</div>
                            </div>
                            <div class="ticket-body">
                                <div class="ticket-details">
                                    <div class="ticket-detail">
                                        <div class="detail-label">Date</div>
                                        <div class="detail-value">{{ \Carbon\Carbon::parse($ticket->event->start_date)->format('d/m/Y') }}</div>
                                    </div>
                                    <div class="ticket-detail">
                                        <div class="detail-label">Heure</div>
                                        <div class="detail-value">{{ \Carbon\Carbon::parse($ticket->event->start_date)->format('H:i') }}</div>
                                    </div>
                                    <div class="ticket-detail">
                                        <div class="detail-label">Siège</div>
                                        <div class="detail-value">{{ $ticket->seat ?? 'Non assigné' }}</div>
                                    </div>
                                    <div class="ticket-detail">
                                        <div class="detail-label">Prix</div>
                                        <div class="detail-value">{{ number_format($ticket->price, 2) }} €</div>
                                    </div>
                                </div>
                                <div class="ticket-qr">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=TICKET{{ $ticket->id }}" alt="QR Code">
                                </div>
                            </div>
                            <div class="ticket-footer">
                                <div class="ticket-id">№ {{ $ticket->reference }}</div>
                                <a href="#" class="btn btn-sm btn-outline-light">Télécharger</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-ticket-alt fa-3x text-purple mb-3"></i>
                    <p>Vous n'avez pas encore de billets.</p>
                    <a href="#" class="btn btn-gradient mt-2">
                        <i class="fas fa-compass me-2"></i> Découvrir des événements
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Profile Header */
    .profile-header {
        margin-bottom: 2rem;
    }
    
    .profile-cover {
        height: 180px;
        background: linear-gradient(90deg, #6B46C1 0%, #8B5CF6 100%);
        border-radius: 1rem;
        position: relative;
        margin-bottom: 3rem;
    }
    
    .profile-avatar-wrapper {
        position: absolute;
        bottom: -50px;
        left: 50px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(90deg, #6B46C1 0%, #8B5CF6 100%);
        padding: 3px;
    }
    
    .profile-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid var(--primary-light);
    }
    
    .profile-info-bar {
        background: rgba(30, 41, 59, 0.6);
        border-radius: 1rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    
    .profile-meta {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 0;
    }
    
    .profile-separator {
        margin: 0 0.5rem;
    }
    
    /* Profile Details Card */
    .profile-details .list-group-item {
        background: transparent;
        border-color: rgba(255, 255, 255, 0.05);
        padding: 1rem 0;
    }
    
    .profile-detail-icon {
        width: 40px;
        height: 40px;
        background: rgba(107, 70, 193, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }
    
    .profile-detail-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
    }
    
    .profile-detail-value {
        font-weight: 500;
    }
    
    /* Preferences */
    .preference-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .preference-item:last-child {
        border-bottom: none;
    }
    
    .preference-label {
        font-weight: 500;
    }
    
    .form-check-input {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.2);
    }
    
    .form-check-input:checked {
        background-color: #6B46C1;
        border-color: #6B46C1;
    }
    
    /* Tables */
    .table {
        color: var(--text-light);
    }
    
    .table th {
        font-weight: 600;
        color: var(--text-muted);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding: 0.75rem 1.5rem;
    }
    
    .table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .event-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .bg-success-soft {
        background-color: rgba(25, 135, 84, 0.15);
    }
    
    .text-success {
        color: #10B981 !important;
    }
    
    /* Tickets */
    .ticket-card {
        background: rgba(30, 41, 59, 0.6);
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }
    
    .ticket-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(107, 70, 193, 0.25);
    }
    
    .ticket-header {
        background: linear-gradient(90deg, #6B46C1 0%, #8B5CF6 100%);
        padding: 1rem;
        display: flex;
        align-items: center;
    }
    
    .ticket-logo {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 0.75rem;
    }
    
    .ticket-event {
        font-weight: 600;
        width: calc(100% - 40px);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .ticket-body {
        padding: 1rem;
        display: flex;
    }
    
    .ticket-details {
        flex-grow: 1;
    }
    
    .ticket-detail {
        display: flex;
        margin-bottom: 0.5rem;
    }
    
    .detail-label {
        width: 70px;
        color: var(--text-muted);
        font-size: 0.85rem;
    }
    
    .detail-value {
        font-weight: 500;
    }
    
    .ticket-qr {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 0.5rem;
        padding: 0.25rem;
    }
    
    .ticket-qr img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .ticket-footer {
        padding: 0.75rem 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .ticket-id {
        font-family: monospace;
        color: var(--text-muted);
    }
    
    /* Responsive */
    @media (max-width: 767.98px) {
        .profile-cover {
            height: 140px;
            margin-bottom: 4rem;
        }
        
        .profile-avatar-wrapper {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .profile-user-info {
            text-align: center;
            width: 100%;
        }
        
        .profile-actions {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        
        .ticket-body {
            flex-direction: column;
        }
        
        .ticket-qr {
            margin-top: 1rem;
            align-self: center;
        }
    }
</style>
@endpush 