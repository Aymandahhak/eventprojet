@extends('layouts.participant')

@section('dashboard-title', 'Mes Événements')

@section('dashboard-content')
<div class="row">
    @if(session('error'))
    <div class="col-12 mb-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="col-12 mb-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between mb-4">
            <h5>Événements à venir</h5>
            <a href="{{ route('events.index') }}" class="btn btn-sm btn-primary rounded-pill">
                <i class="fas fa-search me-2"></i>Découvrir plus d'événements
            </a>
        </div>
        
        @if($registeredEvents->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">Vous n'êtes inscrit à aucun événement</h5>
            <p>Inscrivez-vous à des événements pour les voir apparaître ici</p>
            <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill mt-3">
                <i class="fas fa-search me-2"></i>Découvrir des événements
            </a>
        </div>
        @else
        <div class="row">
            @foreach($registeredEvents as $registration)
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm event-card">
                    <div class="status-badge badge bg-{{ $registration->status == 'confirmed' ? 'success' : ($registration->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($registration->status) }}
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="event-image h-100" style="background-image: url('{{ $registration->event->image ? asset('asset/img/'.$registration->event->image) : asset('asset/img/placeholder.jpg') }}');">
                                <div class="event-date">
                                    <span class="day">{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d') }}</span>
                                    <span class="month">{{ \Carbon\Carbon::parse($registration->event->start_date)->format('M') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column h-100">
                                <h5 class="card-title">{{ $registration->event->title }}</h5>
                                
                                <div class="event-details">
                                    <div class="event-info mb-2">
                                        <i class="fas fa-clock text-primary me-2"></i>
                                        {{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}
                                    </div>
                                    <div class="event-info mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ $registration->event->location }}
                                    </div>
                                    <div class="event-info mb-3">
                                        <i class="fas fa-tag text-primary me-2"></i>
                                        {{ $registration->event->category }}
                                    </div>
                                </div>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-{{ $registration->payment_status == 'paid' ? 'success' : 'warning' }} rounded-pill">
                                            {{ ucfirst($registration->payment_status) }}
                                        </span>
                                        <div class="btn-group">
                                            <a href="{{ route('events.show', $registration->event->id) }}" class="btn btn-sm btn-outline-primary rounded-pill me-2">
                                                <i class="fas fa-eye me-1"></i>Détails
                                            </a>
                                            @if($registration->status == 'confirmed')
                                            <a href="{{ route('participant.tickets.download', $registration->id) }}" class="btn btn-sm btn-primary rounded-pill">
                                                <i class="fas fa-ticket-alt me-1"></i>Billet
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $registeredEvents->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    .event-card {
        border-radius: 15px;
        overflow: hidden;
        position: relative;
    }
    
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
        border-radius: 30px;
        padding: 0.35rem 0.85rem;
        font-size: 0.75rem;
    }
    
    .event-image {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 200px;
        position: relative;
    }
    
    .event-date {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        padding: 8px 12px;
        text-align: center;
        line-height: 1;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .event-date .day {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bs-primary);
    }
    
    .event-date .month {
        display: block;
        font-size: 0.9rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #555;
    }
    
    .event-info {
        font-size: 0.9rem;
        color: #666;
    }
</style>
@endsection 