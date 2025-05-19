@extends('layouts.admin')

@section('dashboard-title', 'Modifier un Événement')

@section('dashboard-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">Modifier l'événement</h4>
                        <a href="{{ route('admin.events.index') }}" class="btn custom-btn-back">
                            <i class="fas fa-arrow-left me-2"></i>Retour
                        </a>
                    </div>

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

                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-label">Titre de l'événement</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="form-label">Catégorie</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">Sélectionner une catégorie</option>
                                        @foreach(['Conférence', 'Séminaire', 'Atelier', 'Formation', 'Concert', 'Festival', 'Exposition', 'Autre'] as $category)
                                            <option value="{{ $category }}" {{ old('category', $event->category) == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Date de début</label>
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" 
                                           value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i')) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">Date de fin</label>
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" 
                                           value="{{ old('end_date', \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i')) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location" class="form-label">Lieu</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event->location) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="capacity" class="form-label">Capacité</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $event->capacity) }}" min="1" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">Type d'événement</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="">Sélectionner un type</option>
                                        @foreach(['Gratuit', 'Payant', 'Sur invitation'] as $type)
                                            <option value="{{ $type }}" {{ old('type', $event->type) == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image de l'événement</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    @if($event->image)
                                        <div class="mt-2">
                                            <small class="text-muted">Image actuelle :</small>
                                            <img src="{{ asset('asset/img/' . $event->image) }}" alt="Image actuelle" class="mt-2" style="max-height: 100px;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.events.index') }}" class="btn custom-btn-cancel">Annuler</a>
                                    <button type="submit" class="btn custom-btn-submit">Enregistrer les modifications</button>
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
    color: #4b5563;
}

.form-control, .form-select {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    border-color: #e5e7eb;
    background-color: #f9fafb;
}

.form-control:focus, .form-select:focus {
    border-color: #9ca3af;
    box-shadow: 0 0 0 0.2rem rgba(156, 163, 175, 0.1);
    background-color: #ffffff;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.custom-btn-back {
    background-color: #f3f4f6;
    color: #4b5563;
    border: none;
}

.custom-btn-back:hover {
    background-color: #e5e7eb;
    color: #374151;
}

.custom-btn-cancel {
    background-color: #f3f4f6;
    color: #4b5563;
    border: none;
}

.custom-btn-cancel:hover {
    background-color: #e5e7eb;
    color: #374151;
}

.custom-btn-submit {
    background-color: #f3f4f6;
    color: #4b5563;
    border: none;
}

.custom-btn-submit:hover {
    background-color: #4b5563;
    color: #ffffff;
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