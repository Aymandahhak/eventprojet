@extends('layouts.participant')

@section('title', 'Participant Dashboard - EventORG')

@section('dashboard-content')
<!-- Statistics Cards -->


<!-- Découverte d'événements avec Design Moderne -->
<div class="content-card mb-5">
    <div class="content-header">
        <h5>Découverte d'événements</h5>
        <a href="{{ route('events.index') }}" class="btn btn-outline">Voir tous les événements</a>
    </div>
    <div class="content-body">
        <div class="events-grid">
            @forelse($recommendedEvents ?? [] as $event)
            <div class="event-card">
                <div class="event-image">
                    @if($event->image)
                        <img src="{{ asset('asset/img/' . $event->image) }}" alt="{{ $event->title }}">
                    @else
                        <div class="placeholder-image">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    @endif
                    <div class="event-badges">
                        <span class="badge badge-primary">{{ $event->category }}</span>
                        <span class="badge badge-dark">{{ $event->type }}</span>
                    </div>
                </div>
                <div class="event-details">
                    <h5 class="event-title">{{ $event->title }}</h5>
                    <div class="event-info">
                        <div class="info-item">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $event->location }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <span>{{ $event->registrations->count() }}/{{ $event->capacity }}</span>
                        </div>
                    </div>
                    <div class="event-footer">
                        <div class="event-price">{{ number_format($event->price, 2) }} €</div>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-primary">Voir détails</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <p>Aucun événement recommandé trouvé</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary">Parcourir tous les événements</a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Historique des inscriptions -->
<div class="content-card mb-5">
    <div class="content-header">
        <h5>Historique des inscriptions</h5>
        <a href="{{ route('participant.events') }}" class="btn btn-outline">Voir tout</a>
    </div>
    <div class="content-body no-padding">
        <div class="registration-history">
            @forelse($upcomingEvents ?? [] as $registration)
            <div class="registration-item">
                <div class="registration-image">
                    @if($registration->event->image)
                        <img src="{{ asset('asset/img/' . $registration->event->image) }}" alt="{{ $registration->event->title }}">
                    @else
                        <div class="placeholder-image">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    @endif
                </div>
                <div class="registration-info">
                    <h5>{{ $registration->event->title }}</h5>
                    <div class="info-row">
                        <div class="info-item">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $registration->event->location }}</span>
                        </div>
                    </div>
                    <div class="status-badges">
                        <span class="badge status-{{ $registration->status }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                        <span class="badge payment-{{ $registration->payment_status }}">
                            {{ ucfirst($registration->payment_status) }}
                        </span>
                    </div>
                </div>
                <div class="registration-actions">
                    <a href="{{ route('events.show', $registration->event) }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-info-circle"></i> Détails
                    </a>
                    <a href="{{ route('participant.tickets.download', $registration) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Télécharger Billet
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <p>Vous n'êtes inscrit à aucun événement</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary">Parcourir les événements</a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Mon Compte -->
<div class="content-card mb-5">
    <div class="content-header">
        <h5>Mon Compte</h5>
    </div>
    <div class="content-body">
        <div class="row profile-section">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="profile-card">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h5>{{ Auth::user()->name }}</h5>
                    <p>{{ Auth::user()->email }}</p>
                    <a href="{{ route('profile') }}" class="btn btn-primary">
                        <i class="fas fa-user-edit"></i> Modifier Profil
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile-details">
                    <h5>Informations personnelles</h5>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Nom complet</span>
                            <span class="info-value">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Rôle</span>
                            <span class="info-value">{{ ucfirst(Auth::user()->role) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Membre depuis</span>
                            <span class="info-value">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('profile') }}" class="btn btn-primary">
                            <i class="fas fa-user-edit"></i> Modifier Informations
                        </a>
                        <a href="{{ route('profile') }}#password" class="btn btn-outline">
                            <i class="fas fa-key"></i> Changer mot de passe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notifications -->
<div class="content-card mb-5" id="notifications">
    <div class="content-header">
        <h5>Notifications</h5>
    </div>
    <div class="content-body no-padding">
        <div class="notifications-list">
            @forelse($notifications ?? [] as $notification)
            <div class="notification-item">
                <div class="notification-icon notification-{{ $notification->type }}">
                    <i class="fas fa-{{ 
                        $notification->type == 'confirmation' ? 'check-circle' : 
                        ($notification->type == 'reminder' ? 'clock' : 
                        ($notification->type == 'cancellation' ? 'times-circle' : 'bell')) 
                    }}"></i>
                </div>
                <div class="notification-content">
                    <h6>{{ $notification->title }}</h6>
                    <p>{{ $notification->message }}</p>
                    <span class="notification-time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                </div>
                <div class="notification-action">
                    <button class="btn-icon">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-bell-slash"></i>
                </div>
                <p>Vous n'avez pas de notifications</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<style>
/* Modern Dashboard Styling */
/* Statistics Cards */
.stat-card {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.05) 100%);
    z-index: 1;
}

.stat-card-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.8rem;
    position: relative;
    z-index: 2;
}

.stat-primary {
    background: linear-gradient(135deg, #6259ca 0%, #8a79fa 100%);
    color: #fff;
}

.stat-success {
    background: linear-gradient(135deg, #2dce89 0%, #4ad49b 100%);
    color: #fff;
}

.stat-info {
    background: linear-gradient(135deg, #11cdef 0%, #1ec6e6 100%);
    color: #fff;
}

.stat-warning {
    background: linear-gradient(135deg, #fb6340 0%, #fbb140 100%);
    color: #fff;
}

.stat-content h6 {
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    opacity: 0.9;
}

.stat-value {
    font-size: 2.2rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 0.75rem;
}

.stat-link, .stat-info {
    font-size: 0.85rem;
    opacity: 0.9;
    color: inherit;
    text-decoration: none;
    display: block;
    margin-top: 0.25rem;
}

.stat-link i {
    transition: transform 0.3s ease;
    margin-left: 0.25rem;
}

.stat-link:hover i {
    transform: translateX(3px);
}

.stat-icon {
    font-size: 2.2rem;
    opacity: 0.9;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 60px;
    width: 60px;
    background: rgba(255,255,255,0.15);
    border-radius: 12px;
    backdrop-filter: blur(5px);
}

/* Content Cards */
.content-card {
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}

.content-card:hover {
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.08);
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.content-header h5 {
    font-weight: 600;
    font-size: 1.25rem;
    margin: 0;
}

.content-body {
    padding: 1.5rem;
}

.content-body.no-padding {
    padding: 0;
}

/* Button Styles */
.btn-outline {
    background: transparent;
    border: 1px solid rgba(0,0,0,0.1);
    color: #666;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-outline:hover {
    background: rgba(0,0,0,0.05);
    color: #444;
}

.btn-primary {
    background: linear-gradient(135deg, #6259ca 0%, #8a79fa 100%);
    border: none;
    border-radius: 8px;
    color: #fff;
    padding: 0.5rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-primary:hover {
    box-shadow: 0 5px 15px rgba(98, 89, 202, 0.4);
    transform: translateY(-2px);
}

.btn-sm {
    padding: 0.375rem 1rem;
    font-size: 0.8125rem;
}

.btn-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(0,0,0,0.05);
    border: none;
    color: #666;
    transition: all 0.3s;
}

.btn-icon:hover {
    background: rgba(0,0,0,0.1);
    color: #444;
}

/* Events Grid */
.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.event-card {
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.05);
    transition: all 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1);
}

.event-image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.event-card:hover .event-image img {
    transform: scale(1.05);
}

.placeholder-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    color: #6259ca;
    font-size: 2.5rem;
}

.event-badges {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    right: 0.75rem;
    display: flex;
    justify-content: space-between;
    z-index: 1;
}

.badge {
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-primary {
    background: #6259ca;
    color: #fff;
}

.badge-dark {
    background: rgba(0,0,0,0.7);
    color: #fff;
}

.status-confirmed {
    background: #2dce89;
    color: #fff;
}

.status-pending {
    background: #fb6340;
    color: #fff;
}

.payment-paid {
    background: #2dce89;
    color: #fff;
}

.payment-pending {
    background: #fb6340;
    color: #fff;
}

.event-details {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.event-title {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.event-info {
    margin-bottom: 1rem;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
    color: #666;
}

.info-item i {
    color: #6259ca;
    width: 18px;
    margin-right: 0.5rem;
}

.event-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid rgba(0,0,0,0.05);
}

.event-price {
    font-weight: 700;
    color: #6259ca;
    font-size: 1.125rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-icon {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 1rem;
}

/* Registration History */
.registration-history {
    display: flex;
    flex-direction: column;
}

.registration-item {
    display: flex;
    padding: 1.25rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.registration-image {
    width: 100px;
    height: 80px;
    min-width: 100px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 1.25rem;
}

.registration-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.registration-info {
    flex: 1;
    min-width: 0;
}

.registration-info h5 {
    font-weight: 600;
    font-size: 1.125rem;
    margin-bottom: 0.5rem;
}

.info-row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 0.75rem;
}

.status-badges {
    display: flex;
    gap: 0.5rem;
}

.registration-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-left: 1.25rem;
    min-width: 140px;
}

/* Profile Section */
.profile-section {
    display: flex;
    flex-wrap: wrap;
}

.profile-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem;
    background: linear-gradient(135deg, rgba(98, 89, 202, 0.03) 0%, rgba(98, 89, 202, 0.06) 100%);
    border-radius: 12px;
    box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.03);
    height: 100%;
}

.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6259ca 0%, #8a79fa 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 5px 15px rgba(98, 89, 202, 0.4);
}

.profile-card h5 {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.profile-card p {
    color: #666;
    margin-bottom: 1.5rem;
}

.profile-details {
    padding: 1.5rem;
    background: linear-gradient(135deg, rgba(98, 89, 202, 0.02) 0%, rgba(98, 89, 202, 0.04) 100%);
    border-radius: 12px;
    height: 100%;
    box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.03);
}

.profile-details h5 {
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
}

.profile-details h5::after {
    content: '';
    position: absolute;
    bottom: -0.5rem;
    left: 0;
    width: 50px;
    height: 3px;
    background: #6259ca;
    border-radius: 3px;
}

.info-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.info-list .info-item {
    display: flex;
    flex-direction: column;
    margin: 0;
}

.info-label {
    font-size: 0.875rem;
    color: #777;
    margin-bottom: 0.25rem;
}

.info-value {
    font-weight: 600;
}

.action-buttons {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

/* Notifications List */
.notifications-list {
    display: flex;
    flex-direction: column;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    padding: 1.25rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    transition: background-color 0.2s;
}

.notification-item:hover {
    background-color: rgba(0,0,0,0.01);
}

.notification-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.notification-confirmation {
    background: rgba(45, 206, 137, 0.1);
    color: #2dce89;
}

.notification-reminder {
    background: rgba(251, 99, 64, 0.1);
    color: #fb6340;
}

.notification-cancellation {
    background: rgba(245, 54, 92, 0.1);
    color: #f5365c;
}

.notification-info {
    background: rgba(17, 205, 239, 0.1);
    color: #11cdef;
}

.notification-content {
    flex: 1;
    min-width: 0;
}

.notification-content h6 {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.notification-content p {
    color: #666;
    margin-bottom: 0.25rem;
    font-size: 0.9375rem;
}

.notification-time {
    font-size: 0.8125rem;
    color: #999;
}

.notification-action {
    margin-left: 1rem;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.stat-card, .content-card, .event-card, .registration-item, .notification-item {
    animation: fadeIn 0.5s ease-out forwards;
}

.dashboard-stats .stat-card:nth-child(1) { animation-delay: 0.1s; }
.dashboard-stats .stat-card:nth-child(2) { animation-delay: 0.2s; }
.dashboard-stats .stat-card:nth-child(3) { animation-delay: 0.3s; }
.dashboard-stats .stat-card:nth-child(4) { animation-delay: 0.4s; }

/* Responsive Adjustments */
@media (max-width: 768px) {
    .events-grid {
        grid-template-columns: 1fr;
    }
    
    .registration-item {
        flex-direction: column;
    }
    
    .registration-image {
        margin-right: 0;
        margin-bottom: 1rem;
        width: 100%;
        height: 120px;
    }
    
    .registration-actions {
        margin-left: 0;
        margin-top: 1rem;
        flex-direction: row;
        width: 100%;
    }
    
    .registration-actions .btn {
        flex: 1;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
        // Add animations to elements when they come into view
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.stat-card, .content-card, .event-card, .registration-item, .notification-item');
            elements.forEach(el => {
                const rect = el.getBoundingClientRect();
                const viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
                if (rect.top <= viewHeight && rect.bottom >= 0) {
                    el.style.visibility = 'visible';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }
            });
        };
        
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Trigger once on load
        
        // Sample event data - would come from the backend in a real application
        const events = [
            @foreach($calendarEvents ?? [] as $event)
            {
                title: '{{ $event->title }}',
                start: '{{ $event->date->format('Y-m-d') }}T{{ $event->time }}',
                url: '{{ route('events.show', $event) }}',
                backgroundColor: '{{ $event->status == 'confirmed' ? '#6259ca' : '#fb6340' }}'
            },
            @endforeach
        ];
        
        if (calendarEl) {
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
                },
                height: 'auto',
                themeSystem: 'bootstrap5',
                dayMaxEvents: true
            });
            
            calendar.render();
        }
    });
</script>
@endsection 