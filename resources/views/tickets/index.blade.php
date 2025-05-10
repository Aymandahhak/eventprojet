@extends('layouts.participant')

@section('dashboard-title', 'Mes Billets')

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
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tous mes billets</h5>
                <p class="text-muted">Retrouvez ici tous vos billets pour les événements à venir et passés.</p>
                
                @if($tickets->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Vous n'avez pas encore de billets</h5>
                    <p>Inscrivez-vous à un événement pour obtenir votre premier billet</p>
                    <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill mt-3">
                        <i class="fas fa-search me-2"></i>Découvrir des événements
                    </a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Événement</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Paiement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ticket-icon me-3 bg-{{ $ticket->status == 'confirmed' ? 'success' : ($ticket->status == 'pending' ? 'warning' : 'danger') }} text-white rounded">
                                            <i class="fas fa-{{ $ticket->event->type == 'online' ? 'laptop' : 'map-marker-alt' }}"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $ticket->event->title }}</h6>
                                            <small class="text-muted">{{ $ticket->event->location }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($ticket->event->start_date)->format('d/m/Y H:i') }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $ticket->status == 'confirmed' ? 'success' : ($ticket->status == 'pending' ? 'warning' : 'danger') }} rounded-pill">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $ticket->payment_status == 'paid' ? 'success' : 'warning' }} rounded-pill">
                                        {{ ucfirst($ticket->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('events.show', $ticket->event) }}" class="btn btn-sm btn-outline-primary rounded-pill" title="Voir l'événement">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        @if($ticket->status == 'confirmed')
                                        <a href="{{ route('participant.tickets.download', $ticket) }}" class="btn btn-sm btn-primary rounded-pill" title="Télécharger le billet">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        @endif
                                        
                                        @if($ticket->status != 'cancelled' && $ticket->event->start_date > now())
                                        <form action="{{ route('registrations.cancel', $ticket) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Annuler l'inscription" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette inscription ?');">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $tickets->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .ticket-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
</style>
@endsection 