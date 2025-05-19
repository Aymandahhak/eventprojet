@extends('layouts.organizer')

@section('dashboard-title', 'Mes Événements')

@section('dashboard-content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Créer un événement
                </a>
            </div>
        </div>
    </div>

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

    <div class="row">
        @forelse($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($event->image)
                        <img src="{{ asset('asset/img/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('asset/img/env2.jpg') }}" class="card-img-top" alt="Default Event Image" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> {{ $event->start_date->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                            </small>
                        </div>
                        <div class="mb-2">
                            <span class="badge {{ $event->is_published ? 'bg-success' : 'bg-warning' }}">
                                {{ $event->is_published ? 'Publié' : 'Non publié' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('organizer.events.destroy', $event) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Vous n'avez pas encore créé d'événements. 
                    <a href="{{ route('organizer.events.create') }}" class="alert-link">Créer votre premier événement</a>
                </div>
            </div>
        @endforelse
    </div>

    @if($events->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                {{ $events->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush 