@extends('layouts.organizer')

@php
use App\Models\Registration;
@endphp

@section('dashboard-title', 'Organizer Profile')

@section('dashboard-content')
<!-- Profile Information -->
<div class="row g-4">
    <!-- Personal Information -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    @if($profile && $profile->logo)
                        <img src="{{ asset('storage/' . $profile->logo) }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" alt="Organizer Logo">
                    @else
                        <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                            <i class="fas fa-user-tie fa-4x text-primary"></i>
                        </div>
                    @endif
                    <h5 class="mt-3">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    
                    @if($profile && $profile->is_verified)
                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Verified Organizer</span>
                    @else
                        <span class="badge bg-warning"><i class="fas fa-clock me-1"></i> Verification Pending</span>
                    @endif
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Name:</span>
                        <span class="fw-medium">{{ $user->name }}</span>
                    </div>
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Email:</span>
                        <span class="fw-medium">{{ $user->email }}</span>
                    </div>
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Phone:</span>
                        <span class="fw-medium">{{ $user->phone ?? 'Not provided' }}</span>
                    </div>
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Member Since:</span>
                        <span class="fw-medium">{{ $user->created_at->format('F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Organization Information -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Organization Information</h5>
            </div>
            <div class="card-body">
                @if($profile)
                    <div class="mb-4">
                        <h6 class="fw-bold">{{ $profile->organization_name }}</h6>
                        <p class="text-muted mb-2"><i class="fas fa-building me-2"></i>{{ $profile->organization_type }}</p>
                        
                        @if($profile->website)
                        <p class="mb-2">
                            <a href="{{ $profile->website }}" target="_blank" class="text-decoration-none">
                                <i class="fas fa-globe me-2"></i>{{ $profile->website }}
                            </a>
                        </p>
                        @endif
                        
                        @if($profile->social_media)
                        <p class="mb-2">
                            <a href="{{ $profile->social_media }}" target="_blank" class="text-decoration-none">
                                <i class="fas fa-share-alt me-2"></i>{{ $profile->social_media }}
                            </a>
                        </p>
                        @endif
                    </div>
                    
                    <h6 class="fw-bold mb-3">About the Organization</h6>
                    <p>{{ $profile->organization_description ?? 'No description provided.' }}</p>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Please complete your organization profile to enhance your credibility as an event organizer.
                    </div>
                @endif
                
                <div class="mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Management Stats -->
<div class="row g-4 mt-4">
    <div class="col-md-3">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Total Events</h6>
                        <h2 class="display-6 fw-bold">{{ $user->organizedEvents()->count() ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Total Participants</h6>
                        <h2 class="display-6 fw-bold">{{ $user->organizedEvents()->withCount('registrations')->get()->sum('registrations_count') ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Published Events</h6>
                        <h2 class="display-6 fw-bold">{{ $user->organizedEvents()->where('is_published', true)->count() ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Total Revenue</h6>
                        <h2 class="display-6 fw-bold">{{ Registration::whereIn('event_id', $user->organizedEvents()->pluck('id'))->sum('total_price') ?? 0 }} DH</h2>
                    </div>
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="card mt-4">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Event Management Features</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <!-- Create Events -->
            <div class="col-md-4">
                <div class="p-4 border rounded h-100">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-primary rounded-circle p-3 text-white">
                            <i class="fas fa-calendar-plus fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="text-center mb-3">Event Creation</h5>
                    <p class="text-muted text-center">Create and manage professional events of all types - conferences, seminars, workshops, and more.</p>
                    <div class="text-center mt-3">
                        <a href="{{ route('events.create') }}" class="btn btn-sm btn-outline-primary">Create Event</a>
                    </div>
                </div>
            </div>
            
            <!-- Manage Registrations -->
            <div class="col-md-4">
                <div class="p-4 border rounded h-100">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-success rounded-circle p-3 text-white">
                            <i class="fas fa-ticket-alt fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="text-center mb-3">Registration Management</h5>
                    <p class="text-muted text-center">Monitor registrations, approve participants, and maintain efficient communication with attendees.</p>
                    <div class="text-center mt-3">
                        <a href="{{ route('organizer.all-registrations') }}" class="btn btn-sm btn-outline-success">Manage Registrations</a>
                    </div>
                </div>
            </div>
            
            <!-- Analytics & Statistics -->
            <div class="col-md-4">
                <div class="p-4 border rounded h-100">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-info rounded-circle p-3 text-white">
                            <i class="fas fa-chart-bar fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="text-center mb-3">Analytics & Statistics</h5>
                    <p class="text-muted text-center">Access comprehensive statistics and reports to track performance and make data-driven decisions.</p>
                    <div class="text-center mt-3">
                        <a href="{{ route('organizer.statistics') }}" class="btn btn-sm btn-outline-info">View Statistics</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('organizer.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Organizer Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="organization_name" class="form-label">Organization Name</label>
                                <input type="text" class="form-control @error('organization_name') is-invalid @enderror" id="organization_name" name="organization_name" value="{{ old('organization_name', $profile->organization_name ?? '') }}">
                                @error('organization_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="organization_type" class="form-label">Organization Type</label>
                                <select class="form-select @error('organization_type') is-invalid @enderror" id="organization_type" name="organization_type">
                                    <option value="">Select Organization Type</option>
                                    <option value="Educational Institution" {{ (old('organization_type', $profile->organization_type ?? '') == 'Educational Institution') ? 'selected' : '' }}>Educational Institution</option>
                                    <option value="Corporate" {{ (old('organization_type', $profile->organization_type ?? '') == 'Corporate') ? 'selected' : '' }}>Corporate</option>
                                    <option value="Non-Profit" {{ (old('organization_type', $profile->organization_type ?? '') == 'Non-Profit') ? 'selected' : '' }}>Non-Profit</option>
                                    <option value="Government" {{ (old('organization_type', $profile->organization_type ?? '') == 'Government') ? 'selected' : '' }}>Government</option>
                                    <option value="Independent Organizer" {{ (old('organization_type', $profile->organization_type ?? '') == 'Independent Organizer') ? 'selected' : '' }}>Independent Organizer</option>
                                    <option value="Other" {{ (old('organization_type', $profile->organization_type ?? '') == 'Other') ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('organization_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="logo" class="form-label">Organization Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo">
                                <div class="form-text">Recommended size: 200x200 pixels (Max: 2MB)</div>
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="website" class="form-label">Website (Optional)</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $profile->website ?? '') }}" placeholder="https://example.com">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="social_media" class="form-label">Social Media (Optional)</label>
                                <input type="text" class="form-control @error('social_media') is-invalid @enderror" id="social_media" name="social_media" value="{{ old('social_media', $profile->social_media ?? '') }}" placeholder="https://linkedin.com/company/your-company">
                                @error('social_media')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="organization_description" class="form-label">Organization Description</label>
                        <textarea class="form-control @error('organization_description') is-invalid @enderror" id="organization_description" name="organization_description" rows="5">{{ old('organization_description', $profile->organization_description ?? '') }}</textarea>
                        @error('organization_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 