@extends('layouts.admin')

@section('dashboard-title', 'Gestion des Utilisateurs')

@section('dashboard-content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des utilisateurs</h1>
        <button class="btn btn-soft-primary">
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach ($users as $user)
            <div class="col-12">
                <div class="card user-card border-0 shadow-sm hover-shadow">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-user fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                    <p class="mb-1 text-muted">
                                        <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                                    </p>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'info' }} bg-opacity-10 text-{{ $user->role === 'admin' ? 'danger' : 'info' }} fw-normal">
                                        <i class="fas fa-user-shield me-1"></i>{{ $user->role }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="btn btn-soft-warning btn-sm px-3">
                                    <i class="fas fa-edit me-2"></i>Modifier
                                </a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" 
                                      method="POST" 
                                      class="d-inline delete-user-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-soft-danger btn-sm px-3">
                                        <i class="fas fa-trash-alt me-2"></i>Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.user-card {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.user-avatar {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-soft-primary {
    background-color: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
    border: none;
}

.btn-soft-warning {
    background-color: rgba(255, 193, 7, 0.1);
    color: #ffc107;
    border: none;
}

.btn-soft-danger {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
    border: none;
}

.btn-soft-primary:hover {
    background-color: #0d6efd;
    color: #fff;
}

.btn-soft-warning:hover {
    background-color: #ffc107;
    color: #fff;
}

.btn-soft-danger:hover {
    background-color: #dc3545;
    color: #fff;
}

.alert {
    border-radius: 10px;
}

.alert-success {
    background-color: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.badge {
    padding: 0.5em 1em;
    font-size: 0.85em;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression
    const deleteForms = document.querySelectorAll('.delete-user-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                this.submit();
            }
        });
    });
});
</script>
@endpush

@endsection
