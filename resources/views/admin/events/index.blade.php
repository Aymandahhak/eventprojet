@extends('layouts.admin')

@section('dashboard-title', 'Gestion des Événements')

@section('dashboard-content')
    <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste des Événements</h1>
    </div>

        @if(session('success'))
        <div class="alert custom-alert alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    <div class="row g-4">
                @foreach ($events as $event)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card event-card border-0 shadow-sm h-100">
                    <div class="event-image-wrapper">
                            @if($event->image)
                            <img src="{{ asset('asset/img/' . $event->image) }}" 
                                 class="card-img-top event-image" 
                                 alt="{{ $event->title }}">
                            @else
                            <img src="{{ asset('asset/img/env2.jpg') }}" 
                                 class="card-img-top event-image" 
                                 alt="Image par défaut">
                            @endif
                        <div class="event-status">
                            @if ($event->is_published)
                                <span class="badge status-badge status-published">
                                    <i class="fas fa-check-circle me-1"></i>Publié
                                </span>
                            @else
                                <span class="badge status-badge status-draft">
                                    <i class="fas fa-clock me-1"></i>Brouillon
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">{{ $event->title }}</h5>
                                <div class="event-id-badge">ID: #{{ $event->id }}</div>
                            </div>
                            <span class="badge category-badge">
                                {{ $event->category }}
                            </span>
                        </div>

                        <div class="event-details">
                            <div class="mb-2">
                                <i class="far fa-calendar me-2 text-neutral"></i>
                                <span class="text-muted">Début:</span>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                            </div>
                            <div class="mb-2">
                                <i class="far fa-calendar-check me-2 text-neutral"></i>
                                <span class="text-muted">Fin:</span>
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                            </div>
                            <div class="mb-2">
                                <i class="fas fa-map-marker-alt me-2 text-neutral"></i>
                                <span class="text-muted">Lieu:</span>
                                {{ $event->location }}
                            </div>
                            <div class="mb-2">
                                <i class="fas fa-users me-2 text-neutral"></i>
                                <span class="text-muted">Capacité:</span>
                                {{ $event->capacity }} personnes
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-tag me-2 text-neutral"></i>
                                <span class="text-muted">Type:</span>
                                <span class="badge type-badge">
                                    {{ $event->type }}
                                </span>
                            </div>
                        </div>

                        <div class="event-actions d-flex flex-column gap-2">
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn custom-btn-edit w-100">
                                <i class="fas fa-edit me-1"></i>Modifier
                            </a>

                            @if (!$event->is_published)
                                <form action="{{ route('admin.events.publish', $event->id) }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn custom-btn-publish w-100">
                                        <i class="fas fa-check me-1"></i>Publier
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.events.unpublish', $event->id) }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn custom-btn-unpublish w-100">
                                        <i class="fas fa-pause me-1"></i>Dépublier
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.events.delete', $event->id) }}" 
                                  method="POST" 
                                  class="delete-event-form w-100">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn custom-btn-delete w-100">
                                    <i class="fas fa-trash-alt me-1"></i>Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
            {{ $events->links() }}
        </div>
    </div>

<style>
.event-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    background-color: #ffffff;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08) !important;
}

.event-image-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.event-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.event-status {
    position: absolute;
    top: 1rem;
    right: 1rem;
}

.event-details {
    font-size: 0.9rem;
}

.text-neutral {
    color: #666666;
}

.status-badge {
    padding: 0.5em 1em;
    font-size: 0.85em;
    border-radius: 50px;
}

.status-published {
    background-color: #e8f5e9;
    color: #2e7d32;
}

.status-draft {
    background-color: #f5f5f5;
    color: #616161;
}

.category-badge {
    background-color: #f3f4f6;
    color: #4b5563;
    padding: 0.5em 1em;
    font-size: 0.85em;
    border-radius: 50px;
}

.type-badge {
    background-color: #f3f4f6;
    color: #4b5563;
    padding: 0.5em 1em;
    font-size: 0.85em;
    border-radius: 50px;
}

.custom-alert {
    background-color: #e8f5e9;
    color: #2e7d32;
    border-radius: 10px;
}

.custom-btn-edit {
    background-color: #f3f4f6;
    color: #4b5563;
    border: none;
    transition: all 0.2s ease;
}

.custom-btn-publish {
    background-color: #e8f5e9;
    color: #2e7d32;
    border: none;
    transition: all 0.2s ease;
}

.custom-btn-unpublish {
    background-color: #fff8e1;
    color: #f57f17;
    border: none;
    transition: all 0.2s ease;
}

.custom-btn-delete {
    background-color: #fef2f2;
    color: #dc2626;
    border: none;
    transition: all 0.2s ease;
}

.custom-btn-edit:hover {
    background-color: #4b5563;
    color: #ffffff;
}

.custom-btn-publish:hover {
    background-color: #2e7d32;
    color: #ffffff;
}

.custom-btn-unpublish:hover {
    background-color: #f57f17;
    color: #ffffff;
}

.custom-btn-delete:hover {
    background-color: #dc2626;
    color: #ffffff;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.event-id-badge {
    background-color: #e5e7eb;
    color: #111827;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    display: inline-block;
}

.btn {
    padding: 0.75rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.25rem;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.event-actions {
    padding-top: 1rem;
    border-top: 1px solid #f3f4f6;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression
    const deleteForms = document.querySelectorAll('.delete-event-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
                this.submit();
            }
        });
    });
});
</script>
@endpush

@endsection
