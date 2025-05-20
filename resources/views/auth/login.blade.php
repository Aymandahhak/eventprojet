@extends('layouts.app')

@section('title', 'Login - Eventify')

@section('content')


<div class="container py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card auth-card p-4 p-md-5">
                <div class="card-header text-center border-0 bg-transparent pt-4">
                    <h3 class="mb-0 display-5 fw-bold text-white">Login</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-4">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                            <label for="email" class="text-muted">Email Address</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            <label for="password" class="text-muted">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-light" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3">
                                Login
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-4">
                                <a href="{{ route('password.request') }}" class="text-light">
                                    Forgot Your Password?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="card-footer text-center py-3 border-0 bg-transparent">
                    <div class="small text-light">
                        Need an account? <a href="{{ route('register') }}" class="fw-bold">Register here!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hero-section-part {
        background: linear-gradient(rgba(15, 23, 42, .7), rgba(15, 23, 42, .7)), url('{{ asset("asset/img/env1.jpg") }}');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 8rem 0;
    }

    .card {
        background-color: var(--card-bg, rgba(28, 22, 60, 0.6));
        border: 1px solid var(--border-color, rgba(255, 255, 255, 0.1));
        border-radius: 15px;
        backdrop-filter: blur(5px);
    }
    
    .card-header, .card-footer {
        background-color: transparent !important;
        border-top: 1px solid var(--border-color, rgba(255, 255, 255, 0.1));
    }
    .card-header {
        border-bottom: 1px solid var(--border-color, rgba(255, 255, 255, 0.1));
    }
    
    .card-header.border-0 { border: 0 !important; }
    .card-footer.border-0 { border: 0 !important; }

    .form-control::placeholder {
        color: var(--text-muted, #a0aec0);
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(var(--accent-start-rgb, 108), var(--accent-start-rgb-g, 91), var(--accent-start-rgb-b, 123), 0.5);
        border-color: var(--accent-start, #6c5b7b);
    }
    
    a {
        color: var(--accent-start, #6c5b7b);
        text-decoration: none;
    }
    a:hover {
        color: var(--accent-end, #c06c84);
    }
    .text-light a, a.text-light {
        color: var(--text-light, #f0f0f0);
    }
     .text-light a:hover, a.text-light:hover {
        color: var(--accent-start, #6c5b7b);
    }
    .card-footer a {
        color: var(--accent-start, #6c5b7b);
        font-weight: bold;
    }
    .card-footer a:hover {
        color: var(--accent-end, #c06c84);
    }

</style>
@endpush