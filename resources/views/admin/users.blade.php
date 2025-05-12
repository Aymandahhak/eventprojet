@extends('layouts.admin')

@section('dashboard-title', 'Admin Overview')

@section('dashboard-content')
    <div class="container">
        <h1 class="mb-4">Gestion des utilisateurs</h1>

        <!-- Vérifier s'il y a un message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des utilisateurs -->
        @foreach ($users as $user)
            <div class="user-card mb-3 p-3 border rounded">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>{{ $user->name }}</h5>
                        <p>{{ $user->email }}</p>
                        <p><strong>Rôle :</strong> {{ $user->role }}</p> <!-- Affichage du rôle -->
                    </div>
                    <div class="text-right">
                        <!-- Modifier -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <!-- Supprimer -->
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
