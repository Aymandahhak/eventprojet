@extends('layouts.admin')

@section('dashboard-title', 'My Profile Settings')

@section('dashboard-content')
<div class="container-fluid px-4 py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0">
            <h5 class="mb-0">
                <i class="fas fa-user-edit me-2 text-primary"></i>
                Edit Profile
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ auth()->user()->name }}">
                            @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ auth()->user()->email }}">
                            @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <hr class="my-4">

                        <h6 class="mb-4">Change Password</h6>
                        
                        <div class="form-group mb-4">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" 
                                class="form-control @error('current_password') is-invalid @enderror" 
                                id="current_password" 
                                name="current_password">
                            @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" 
                                class="form-control @error('new_password') is-invalid @enderror" 
                                id="new_password" 
                                name="new_password">
                            @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" 
                                class="form-control" 
                                id="new_password_confirmation" 
                                name="new_password_confirmation">
                </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 1rem;
    overflow: hidden;
}

.form-control {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    border-color: #e0e0e0;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1);
}

.btn-primary {
    padding: 0.75rem 2rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(78, 115, 223, 0.1);
}
</style>
@endsection
