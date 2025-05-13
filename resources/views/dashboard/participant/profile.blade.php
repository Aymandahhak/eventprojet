@extends('layouts.participant')

@section('dashboard-title', 'Mon Profil')

@section('dashboard-content')
<div class="row g-4">
    <div class="col-md-12 mb-4">
        <div class="content-card">
            <div class="content-header">
                <h5>Informations Personnelles</h5>
            </div>
            <div class="content-body">
                @if(session('success'))
                    <div class="alert-custom alert-success mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        <span>{{ session('success') }}</span>
                        <button class="alert-close"><i class="fas fa-times"></i></button>
                    </div>
                @endif
                
                <form action="{{ route('participant.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-floating form-group-custom">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Nom complet">
                                <label for="name">Nom complet</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-group-custom">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Email">
                                <label for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-floating form-group-custom">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Téléphone">
                                <label for="phone">Téléphone</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-group-custom">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', Auth::user()->address) }}" placeholder="Adresse">
                                <label for="address">Adresse</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-12" id="password">
        <div class="content-card">
            <div class="content-header">
                <h5>Changer le mot de passe</h5>
            </div>
            <div class="content-body">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-floating form-group-custom">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Mot de passe actuel">
                                <label for="current_password">Mot de passe actuel</label>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-floating form-group-custom">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nouveau mot de passe">
                                <label for="password">Nouveau mot de passe</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-group-custom">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le nouveau mot de passe">
                                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="password-strength mb-4" id="password-strength">
                        <div class="strength-meter">
                            <div class="strength-meter-fill" data-strength="0"></div>
                        </div>
                        <div class="strength-text">Force du mot de passe: <span>Pas de mot de passe</span></div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key me-2"></i>Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Form Styling */
.form-group-custom {
    position: relative;
    margin-bottom: 1rem;
}

.form-floating {
    position: relative;
}

.form-floating > .form-control {
    height: 60px;
    border: 2px solid rgba(0,0,0,0.05);
    border-radius: 12px;
    background: rgba(255,255,255,0.8);
    padding: 1.5rem 1rem 0.5rem;
    font-size: 1rem;
    box-shadow: 0 3px 10px rgba(0,0,0,0.02);
    transition: all 0.3s ease;
}

.form-floating > label {
    padding: 1rem;
    opacity: 0.6;
}

.form-floating > .form-control:focus {
    border-color: #6259ca;
    box-shadow: 0 5px 15px rgba(98, 89, 202, 0.1);
}

.form-floating > .form-control:hover {
    border-color: rgba(98, 89, 202, 0.3);
}

.form-control.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.1);
}

.invalid-feedback {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #dc3545;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
}

.alert-custom {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    animation: slideInDown 0.5s;
}

.alert-success {
    background: rgba(45, 206, 137, 0.1);
    color: #2dce89;
    border-left: 4px solid #2dce89;
}

.alert-custom i {
    font-size: 1.25rem;
    margin-right: 0.75rem;
}

.alert-custom span {
    flex: 1;
}

.alert-close {
    background: none;
    border: none;
    color: inherit;
    opacity: 0.7;
    cursor: pointer;
    transition: opacity 0.3s;
}

.alert-close:hover {
    opacity: 1;
}

/* Password Strength Meter */
.password-strength {
    margin-top: 0.5rem;
}

.strength-meter {
    height: 6px;
    background: #eee;
    border-radius: 3px;
    margin-bottom: 0.75rem;
    overflow: hidden;
}

.strength-meter-fill {
    height: 100%;
    border-radius: 3px;
    transition: all 0.3s ease;
    width: 0;
}

.strength-meter-fill[data-strength="0"] {
    width: 0;
    background: #dc3545;
}

.strength-meter-fill[data-strength="1"] {
    width: 25%;
    background: #dc3545;
}

.strength-meter-fill[data-strength="2"] {
    width: 50%;
    background: #ffc107;
}

.strength-meter-fill[data-strength="3"] {
    width: 75%;
    background: #6259ca;
}

.strength-meter-fill[data-strength="4"] {
    width: 100%;
    background: #2dce89;
}

.strength-text {
    font-size: 0.875rem;
    color: #666;
}

.strength-text span {
    font-weight: 600;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password strength meter functionality
    const passwordInput = document.getElementById('password');
    const strengthMeter = document.querySelector('.strength-meter-fill');
    const strengthText = document.querySelector('.strength-text span');
    
    if (passwordInput && strengthMeter) {
        passwordInput.addEventListener('input', function() {
            const val = passwordInput.value;
            let strength = 0;
            
            if (val.length > 0) {
                // Has length
                if (val.length >= 8) strength++;
                // Has lowercase and uppercase
                if (val.match(/[a-z]/) && val.match(/[A-Z]/)) strength++;
                // Has numbers
                if (val.match(/\d/)) strength++;
                // Has special chars
                if (val.match(/[^a-zA-Z\d]/)) strength++;
                
                const strengthLabels = ['Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
                strengthText.textContent = strengthLabels[strength];
            } else {
                strengthText.textContent = 'Pas de mot de passe';
            }
            
            strengthMeter.setAttribute('data-strength', strength);
        });
    }
    
    // Alert close button functionality
    const alertCloseButtons = document.querySelectorAll('.alert-close');
    alertCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const alert = this.closest('.alert-custom');
            alert.style.opacity = '0';
            setTimeout(() => alert.style.display = 'none', 300);
        });
    });
    
    // Form animations
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach((control, index) => {
        control.style.opacity = '0';
        control.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
            control.style.transition = 'all 0.5s ease';
            control.style.opacity = '1';
            control.style.transform = 'translateY(0)';
        }, 100 + (index * 50));
    });
});
</script>
@endsection 