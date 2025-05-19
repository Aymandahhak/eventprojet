@extends('layouts.organizer')

@section('dashboard-title', 'Gestion des Inscriptions')

@section('dashboard-content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Événement</th>
                            <th>Participant</th>
                            <th>Email</th>
                            <th>Date d'inscription</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                            <tr>
                                <td>{{ $registration->event->title }}</td>
                                <td>{{ $registration->user->name }}</td>
                                <td>{{ $registration->user->email }}</td>
                                <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge {{ $registration->status === 'confirmed' ? 'bg-success' : ($registration->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if($registration->status === 'pending')
                                            <form action="{{ route('organizer.registrations.confirm', $registration) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success me-2">
                                                    <i class="fas fa-check"></i> Confirmer
                                                </button>
                                            </form>
                                            <form action="{{ route('organizer.registrations.reject', $registration) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette inscription ?')">
                                                    <i class="fas fa-times"></i> Rejeter
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('organizer.registrations.show', $registration) }}" class="btn btn-sm btn-info ms-2">
                                            <i class="fas fa-eye"></i> Détails
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune inscription trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($registrations->hasPages())
        <div class="mt-4">
            {{ $registrations->links() }}
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .table td, .table th {
        vertical-align: middle;
    }
    .btn-group .btn {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }
</style>
@endpush 