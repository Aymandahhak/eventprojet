@extends('layouts.app')

@section('content')
<div class="container-fluid position-relative p-0">
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-6 text-center text-lg-center">
                    <h1 class="display-3 text-white mb-4 animated slideInDown">Create Account</h1>
                    <p class="fs-5 text-white mb-4 animated slideInDown">Join our community and start exploring events today</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">Create Account</h3>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="name">Full Name</label>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label for="password-confirm">Confirm Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_organizer" name="is_organizer">
                                <label class="form-check-label" for="is_organizer">Tu es un organisateur ?</label>
                            </div>
                        </div>

                        <div id="organizer_fields" style="display: none;">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input id="organization_name" type="text" class="form-control @error('organization_name') is-invalid @enderror" name="organization_name" value="{{ old('organization_name') }}">
                                        <label for="organization_name">Nom de l'organisation</label>
                                        @error('organization_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select id="organization_type" class="form-control @error('organization_type') is-invalid @enderror" name="organization_type">
                                            <option value="">Sélectionner</option>
                                            <option value="Entreprise">Entreprise</option>
                                            <option value="Association">Association</option>
                                            <option value="École">École</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                        <label for="organization_type">Type d'organisation</label>
                                        @error('organization_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea id="organization_description" class="form-control @error('organization_description') is-invalid @enderror" name="organization_description" style="height: 100px">{{ old('organization_description') }}</textarea>
                                    <label for="organization_description">Description de l'organisation</label>
                                    @error('organization_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Hidden input for role - will be updated via JS -->
                        <input type="hidden" name="role" id="role_input" value="participant">

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small">
                        Already have an account? <a href="{{ route('login') }}" class="text-primary">Login here!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded');
        const isOrganizerCheckbox = document.getElementById('is_organizer');
        const organizerFields = document.getElementById('organizer_fields');
        const roleInput = document.getElementById('role_input');
        
        if (!isOrganizerCheckbox || !organizerFields || !roleInput) {
            console.error('One or more elements not found:', {
                checkbox: isOrganizerCheckbox,
                fields: organizerFields,
                role: roleInput
            });
            return;
        }
        
        console.log('Elements found, setting up event listener');
        
        // Toggle organizer fields visibility based on checkbox
        isOrganizerCheckbox.addEventListener('change', function() {
            console.log('Checkbox changed:', this.checked);
            if (this.checked) {
                organizerFields.style.display = 'block';
                roleInput.value = 'organisateur';
                
                // Make organizer fields required
                document.getElementById('organization_name').required = true;
                document.getElementById('organization_type').required = true;
            } else {
                organizerFields.style.display = 'none';
                roleInput.value = 'participant';
                
                // Remove required attribute from organizer fields
                document.getElementById('organization_name').required = false;
                document.getElementById('organization_type').required = false;
            }
        });
        
        // Also check initial state (in case the page reloads with checkbox checked)
        if (isOrganizerCheckbox.checked) {
            organizerFields.style.display = 'block';
            roleInput.value = 'organisateur';
        }
    });
</script>
@endpush