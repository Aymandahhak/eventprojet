@extends('layouts.admin')

@section('dashboard-title', 'Créer un Événement')

@section('dashboard-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4">Créer un nouvel événement</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-label">Titre de l'événement</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="form-label">Catégorie</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">Sélectionner une catégorie</option>
                                        <option value="Conférence">Conférence</option>
                                        <option value="Séminaire">Séminaire</option>
                                        <option value="Atelier">Atelier</option>
                                        <option value="Formation">Formation</option>
                                        <option value="Concert">Concert</option>
                                        <option value="Festival">Festival</option>
                                        <option value="Exposition">Exposition</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Date de début</label>
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">Date de fin</label>
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location" class="form-label">Lieu</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="capacity" class="form-label">Capacité</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">Type d'événement</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="">Sélectionner un type</option>
                                        <option value="Gratuit">Gratuit</option>
                                        <option value="Payant">Payant</option>
                                        <option value="Sur invitation">Sur invitation</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image de l'événement</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.events.index') }}" class="btn btn-light">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Créer l'événement</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    border-color: #e0e0e0;
}

.form-control:focus, .form-select:focus {
    border-color: #2196f3;
    box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.1);
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
}

.card {
    border-radius: 1rem;
}

.alert {
    border-radius: 0.5rem;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation des dates
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    function validateDates() {
        if (startDateInput.value && endDateInput.value) {
            if (new Date(endDateInput.value) <= new Date(startDateInput.value)) {
                endDateInput.setCustomValidity('La date de fin doit être postérieure à la date de début');
            } else {
                endDateInput.setCustomValidity('');
            }
        }
    }

    startDateInput.addEventListener('change', validateDates);
    endDateInput.addEventListener('change', validateDates);
});
</script>
@endpush

@endsection 