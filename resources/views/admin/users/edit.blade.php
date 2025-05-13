@extends('layouts.admin')

@section('dashboard-title', 'Modifier l\'utilisateur')

@section('dashboard-content')
    <div class="container">
        <h1>Modifier l'utilisateur : {{ $user->name }}</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="role">Rôle</label>
                <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $user->role) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
