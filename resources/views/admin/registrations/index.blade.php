@extends('layouts.admin')

@section('dashboard-title', 'Gestion des Inscriptions')

@section('dashboard-content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste des Inscriptions</h1>
        <div class="d-flex gap-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher...">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
            <tr>
                            <th class="border-0">Utilisateur</th>
                            <th class="border-0">Événement</th>
                            <th class="border-0">Quantité</th>
                            <th class="border-0">Prix total</th>
                            <th class="border-0">Code Ticket</th>
                            <th class="border-0">Statut</th>
                            <th class="border-0">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $registration)
                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">
                                            {{ strtoupper(substr($registration->user->name, 0, 1)) }}
                                        </div>
                                        <div>{{ $registration->user->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-wrap">{{ $registration->event->title }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $registration->ticket_quantity }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $registration->total_price }} MAD</span>
                                </td>
                                <td>
                                    <code class="ticket-code">{{ $registration->ticket_code }}</code>
                                </td>
                    <td>
                        @if($registration->status === 'confirmed')
                            <span class="status-badge status-confirmed">
                                <i class="fas fa-check-circle me-2"></i>Confirmée
                            </span>
                        @elseif($registration->status === 'cancelled')
                            <span class="status-badge status-cancelled">
                                <i class="fas fa-times-circle me-2"></i>Annulée
                            </span>
                        @else
                            <span class="status-badge status-pending">
                                <i class="fas fa-clock me-2"></i>En attente
                            </span>
                        @endif
                    </td>
                    <td>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('admin.registrations.validate', $registration->id) }}" method="POST">
                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Valider">
                                                <i class="fas fa-check"></i>
                                            </button>
                        </form>

                                        <form action="{{ route('admin.registrations.deactivate', $registration->id) }}" method="POST">
                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Désactiver">
                                                <i class="fas fa-pause"></i>
                                            </button>
                        </form>

                                        <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                        </form>
                                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-circle {
    width: 32px;
    height: 32px;
    background-color: #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    color: #495057;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 0.75rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.status-confirmed {
    background-color: #d1fae5;
    color: #065f46;
}

.status-cancelled {
    background-color: #fee2e2;
    color: #991b1b;
}

.status-pending {
    background-color: #fef3c7;
    color: #92400e;
}

.status-badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.ticket-code {
    background-color: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
    color: #495057;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
}

.btn-outline-success:hover, 
.btn-outline-warning:hover, 
.btn-outline-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.alert {
    border: none;
    border-radius: 8px;
}

.card {
    border: none;
    border-radius: 10px;
    transition: all 0.2s ease;
}

.card:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
})
</script>
@endsection
