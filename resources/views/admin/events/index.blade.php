@extends('layouts.admin')

@section('dashboard-title', 'Gestion des Événements')

@section('dashboard-content')
    <div class="container">
        <h1 class="mb-4">Liste des Événements</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th> <!-- Colonne pour l'image -->
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Date de début</th>
                    <th>Date de fin</th> <!-- Nouvelle colonne pour la date de fin -->
                    <th>Lieu</th> <!-- Nouvelle colonne pour le lieu -->
                    <th>Capacité</th> <!-- Nouvelle colonne pour la capacité -->
                    <th>Type</th> <!-- Nouvelle colonne pour le type -->
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <!-- Affichage de l'image -->
                        <td>
                            @if($event->image)
                                <img src="{{ asset('asset/img/' . $event->image) }}" class="rounded" style="width: 70px; height: 70px; object-fit: cover;" alt="{{ $event->title }}">
                            @else
                                <img src="{{ asset('asset/img/env2.jpg') }}" class="rounded" style="width: 70px; height: 70px; object-fit: cover;" alt="Image par défaut">
                            @endif
                        </td>

                        <td>{{ $event->title }}</td>
                        <td>{{ $event->category }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td> <!-- Affichage de la date de fin -->
                        <td>{{ $event->location }}</td> <!-- Affichage du lieu -->
                        <td>{{ $event->capacity }}</td> <!-- Affichage de la capacité -->
                        <td>{{ $event->type }}</td> <!-- Affichage du type -->
                        <td>
                            @if ($event->is_published)
                                <span class="badge bg-success">Publié</span>
                            @else
                                <span class="badge bg-secondary">Brouillon</span>
                            @endif
                        </td>
                        <td>
                            @if (!$event->is_published)
                                <form action="{{ route('admin.events.publish', $event->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Publier</button>
                                </form>
                            @else
                                <form action="{{ route('admin.events.unpublish', $event->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Dépublier</button>
                                </form>
                            @endif

                            <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $events->links() }}
        </div>
    </div>
@endsection
