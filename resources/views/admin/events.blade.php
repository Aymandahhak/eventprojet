@extends('layouts.admin')

@section('dashboard-title', 'Liste des Événements')

@section('dashboard-content')
<div class="container-fluid px-0">
    <div class="card border-0 shadow-sm mb-4 rounded-4">
        <div class="card-header bg-white border-bottom rounded-top-4">
            <h4 class="mb-0 fw-semibold">📅 Événements</h4>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th> <!-- Image Column First -->
                            <th>Titre</th>
                            <th>Organisateur</th>
                            <th>Catégorie</th> <!-- New column for category -->
                            <th>Prix</th> <!-- New column for price -->
                            <th>Lieu</th> <!-- New column for location -->
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <!-- Display Image in First Column -->
                                <td>
                                    @if ($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" alt="Image de l'événement" style="width: 100px; height: auto;">
                                    @else
                                        Pas d'image
                                    @endif
                                </td>

                                <!-- Display Event Title -->
                                <td class="fw-medium">{{ $event->title }}</td>

                                <!-- Display Organizer -->
                                <td>{{ $event->organizer->name ?? 'N/A' }}</td>

                                <!-- Display Category -->
                                <td>{{ $event->category }}</td>

                                <!-- Display Price -->
                                <td>{{ $event->price }} €</td>

                                <!-- Display Location -->
                                <td>{{ $event->location }}</td>

                                <!-- Display Start Date -->
                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</td>

                                <!-- Display End Date -->
                                <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</td>

                                <!-- Display Status -->
                                <td>
                                    @if ($event->is_published)
                                        <span class="badge bg-success">Publié</span>
                                    @else
                                        <span class="badge bg-secondary">Brouillon</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-muted py-4">Aucun événement trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white py-3">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
