@extends('layouts.admin')

@section('dashboard-title', 'Gestion des Inscriptions')

@section('dashboard-content')
<div class="container">
    <h1 class="mb-4">Liste des Inscriptions</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom de l'utilisateur</th>
                <th>Événement</th>
                <th>Quantité</th>
                <th>Prix total</th>
                <th>Code Ticket</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $registration)
                <tr>
                    <td>{{ $registration->user->name }}</td>
                    <td>{{ $registration->event->title }}</td>
                    <td>{{ $registration->ticket_quantity }}</td>
                    <td>{{ $registration->total_price }} MAD</td>
                    <td>{{ $registration->ticket_code }}</td>
                    <td>
                        @if($registration->status === 'confirmed')
                            <span class="badge bg-success">Confirmée</span>
                        @elseif($registration->status === 'cancelled')
                            <span class="badge bg-danger">Annulée</span>
                        @else
                            <span class="badge bg-warning">En attente</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.registrations.validate', $registration->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Valider</button>
                        </form>

                        <form action="{{ route('admin.registrations.deactivate', $registration->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Désactiver</button>
                        </form>

                        <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
