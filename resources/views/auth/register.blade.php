@extends('layouts.app')

@section('title', 'Register - Eventify')

@section('content')
{{-- Hero Section --}}
<div class="container-fluid position-relative p-0">
    {{-- Replaced bg-primary with new hero style from login.blade.php --}}
    <div class="container-fluid py-5 mb-5 hero-section-part">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-8 text-center">
                    <h1 class="display-3 text-white mb-4 animated slideInDown">Create Your Eventify Account</h1>
                    <p class="fs-4 text-light mb-4 animated slideInDown">Join our platform to discover, create, and manage events seamlessly.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Registration Form Section --}}
<div class="container py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-card p-4 p-md-5">
                <div class="card-header text-center border-0 bg-transparent pt-4">
                    <h3 class="mb-0 display-5 fw-bold text-white">Create Your Account</h3>
                    <p class="text-muted mt-2">Join our platform to discover, create, and manage events seamlessly.</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name">
                                    <label for="name" class="text-muted">Full Name</label>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                                    <label for="email" class="text-muted">Email Address</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                    <label for="password" class="text-muted">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                    <label for="password-confirm" class="text-muted">Confirm Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 ps-0"> 
                             <div class="d-flex align-items-center">
                                <input type="checkbox" id="checkboxInput" name="is_organizer" {{ old('is_organizer') ? 'checked' : '' }}>
                                <label for="checkboxInput" class="toggleSwitch me-3"></label>
                                <label class="form-check-label text-light" for="checkboxInput">Register as an event organizer</label>
                            </div>
                        </div>

                        <div id="organizer_fields" style="display: {{ old('is_organizer') ? 'block' : 'none' }};">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input id="organization_name" type="text" class="form-control @error('organization_name') is-invalid @enderror" name="organization_name" value="{{ old('organization_name') }}" placeholder="Organization Name">
                                        <label for="organization_name" class="text-muted">Organization Name</label>
                                        @error('organization_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select id="organization_type" class="form-select @error('organization_type') is-invalid @enderror" name="organization_type">
                                            <option value="" selected disabled>Select Type</option>
                                            <option value="Entreprise" {{ old('organization_type') == 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                                            <option value="Association" {{ old('organization_type') == 'Association' ? 'selected' : '' }}>Association</option>
                                            <option value="École" {{ old('organization_type') == 'École' ? 'selected' : '' }}>École</option>
                                            <option value="Autre" {{ old('organization_type') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        <label for="organization_type" class="text-muted">Organization Type</label>
                                        @error('organization_type')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea id="organization_description" class="form-control @error('organization_description') is-invalid @enderror" name="organization_description" style="height: 100px" placeholder="Organization Description">{{ old('organization_description') }}</textarea>
                                <label for="organization_description" class="text-muted">Organization Description</label>
                                @error('organization_description')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="role" id="role_input" value="{{ old('is_organizer') ? 'organisateur' : 'participant' }}">

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 border-0 bg-transparent">
                    <div class="small text-light">
                        Already have an account? <a href="{{ route('login') }}" class="fw-bold">Login here!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Auth Card Styles */
    .auth-card {
        background-color: var(--card-bg, rgba(28, 22, 60, 0.6));
        border: 1px solid var(--border-color, rgba(255, 255, 255, 0.1));
        border-radius: 15px;
        backdrop-filter: blur(5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    /* Form Styles */
    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.05); 
        color: var(--text-light, #f0f0f0);
        border: 1px solid var(--border-color, rgba(255, 255, 255, 0.1));
        border-radius: 10px;
        padding: 12px 15px;
    }
    
    .form-control::placeholder {
        color: var(--text-muted, #a0aec0);
    }
    
    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 0 0.25rem rgba(58, 52, 86, 0.5);
        border-color: var(--accent-start, #3a3456);
        color: var(--text-white, #ffffff);
    }
    
    .form-select {
        background-color: rgba(255, 255, 255, 0.05);
        color: var(--text-light, #f0f0f0);
    }
    
    .form-select:focus {
        border-color: var(--accent-start, #3a3456);
        box-shadow: 0 0 0 0.25rem rgba(58, 52, 86, 0.5);
    }
    
    .form-select option {
        background-color: var(--primary-medium, #101624);
        color: var(--text-light, #f0f0f0);
    }

    /* To hide the checkbox */
    #checkboxInput {
      display: none;
    }

    .toggleSwitch {
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      width: 90px;
      height: 30px;
      background-color: rgb(206, 206, 206);
      border-radius: 40px;
      cursor: pointer;
      transition-duration: .3s;
    }

    .toggleSwitch::after {
      content: "";
      position: absolute;
      height: 30px;
      width: 50%;
      left: 0px;
      background: conic-gradient(rgba(26, 26, 26, 0.555),white,rgba(26, 26, 26, 0.555),white,rgba(26, 26, 26, 0.555));
      border-radius: 40px;
      transition-duration: .3s;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.281);
    }

    #checkboxInput:checked+.toggleSwitch::after {
      transform: translateX(100%);
      transition-duration: .3s;
    }
    /* Switch background change */
    #checkboxInput:checked+.toggleSwitch {
      background-color: var(--accent-start, #3a3456);
      transition-duration: .3s;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isOrganizerCheckbox = document.getElementById('checkboxInput');
        const organizerFields = document.getElementById('organizer_fields');
        const roleInput = document.getElementById('role_input');
        const orgNameInput = document.getElementById('organization_name');
        const orgTypeInput = document.getElementById('organization_type');

        function toggleOrganizerFields() {
            if (isOrganizerCheckbox.checked) {
                organizerFields.style.display = 'block';
                roleInput.value = 'organisateur';
                if(orgNameInput) orgNameInput.required = true;
                if(orgTypeInput) orgTypeInput.required = true;
            } else {
                organizerFields.style.display = 'none';
                roleInput.value = 'participant';
                if(orgNameInput) orgNameInput.required = false;
                if(orgTypeInput) orgTypeInput.required = false;
            }
        }

        if (isOrganizerCheckbox && organizerFields && roleInput) {
            isOrganizerCheckbox.addEventListener('change', toggleOrganizerFields);
            // Initial check in case of page reload with field already checked (e.g., validation error)
            toggleOrganizerFields(); 
        } else {
            console.error('One or more elements for organizer fields toggle not found.');
        }
    });
</script>
@endpush