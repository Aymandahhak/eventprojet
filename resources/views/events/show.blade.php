@extends('layouts.app')

@section('styles')
<style>
    .event-image {
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        max-height: 450px;
        object-fit: cover;
        width: 100%;
    }
    
    .page-header {
        padding: 3rem 0;
        margin-bottom: 2rem;
        background-color: rgba(10, 15, 31, 0.5);
        backdrop-filter: blur(5px);
        border-bottom: 1px solid var(--border-color);
    }
    
    .breadcrumb-item a {
        color: var(--accent-start);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .breadcrumb-item a:hover {
        color: var(--accent-end);
    }
    
    .breadcrumb-item.active {
        color: var(--text-light);
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: var(--text-muted);
    }
    
    .event-detail-card {
        margin-bottom: 2rem;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        backdrop-filter: blur(5px);
    }
    
    .event-detail-card .card-title {
        color: var(--text-white);
        font-weight: 600;
        margin-bottom: 1.5rem;
        font-size: 1.25rem;
        position: relative;
        padding-bottom: 0.75rem;
    }
    
    .event-detail-card .card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-start), var(--accent-end));
    }
    
    .event-detail-card strong {
        color: var(--text-white);
    }
    
    .event-detail-card p {
        color: var(--text-muted);
    }
    
    .event-detail-card i {
        color: var(--accent-start);
        width: 20px;
        text-align: center;
        margin-right: 0.5rem;
    }
    
    .event-detail-card .badge {
        background: linear-gradient(90deg, var(--accent-start), var(--accent-end));
        color: var(--text-white);
        font-weight: 500;
        padding: 0.5rem 1rem;
    }
    
    .social-share-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-light);
        border: 1px solid var(--border-color);
    }
    
    .social-share-btn:hover {
        background: linear-gradient(90deg, var(--accent-start), var(--accent-end));
        color: var(--text-white);
        transform: translateY(-3px);
        border-color: transparent;
    }
    
    .registration-card {
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        backdrop-filter: blur(5px);
    }
    
    .registration-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-white);
        margin-bottom: 0;
    }
    
    .registration-spots {
        color: var(--accent-start);
        font-weight: 600;
    }
    
    .alert-custom {
        background: rgba(var(--accent-end-rgb), 0.1);
        border: 1px solid var(--accent-start);
        color: var(--text-white);
        border-radius: 10px;
    }
    
    .alert-custom i {
        color: var(--accent-start);
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $event->title }}</li>
                    </ol>
                </nav>
                <h1 class="display-5 mb-3">{{ $event->title }}</h1>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary rounded-pill px-3 py-2 me-3">{{ $event->category }}</span>
                    <span class="text-muted"><i class="far fa-calendar-alt text-primary me-1"></i> {{ $event->start_date->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            @if($event->image)
            <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
                <img src="{{ asset('asset/img/' . $event->image) }}" class="event-image" alt="{{ $event->title }}">
            </div>
            @endif

            <div class="event-detail-card wow fadeInUp" data-wow-delay="0.2s">
                <div class="card-body p-4">
                    <h5 class="card-title">Event Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><i class="fas fa-calendar"></i> <strong>Date:</strong> {{ $event->start_date->format('M d, Y') }}</p>
                            <p><i class="fas fa-clock"></i> <strong>Time:</strong> {{ $event->start_date->format('h:i A') }} - {{ $event->end_date->format('h:i A') }}</p>
                            <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $event->location }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-tag"></i> <strong>Category:</strong> {{ $event->category }}</p>
                            <p><i class="fas fa-users"></i> <strong>Capacity:</strong> {{ $event->capacity }} participants</p>
                            <p><i class="fas fa-ticket-alt"></i> <strong>Price:</strong> {{ $event->formatted_price }}</p>
                            <p>
                                <i class="fas fa-laptop-house"></i> <strong>Type:</strong> 
                                <span class="badge rounded-pill">
                                    {{ $event->type }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-detail-card wow fadeInUp" data-wow-delay="0.3s">
                <div class="card-body p-4">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{ $event->description }}</p>
                </div>
            </div>

            @can('update', $event)
            <div class="event-detail-card wow fadeInUp" data-wow-delay="0.4s">
                <div class="card-body p-4">
                    <h5 class="card-title">Event Management</h5>
                    <div class="d-flex gap-3">
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i> Edit Event
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">
                                <i class="fas fa-trash me-2"></i> Delete Event
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endcan
        </div>

        <div class="col-lg-4">
            <div class="registration-card wow fadeInUp" data-wow-delay="0.3s">
                <div class="card-body p-4">
                    <h5 class="card-title">Registration</h5>
                    @if($event->is_full)
                    <div class="alert alert-custom">
                        <i class="fas fa-exclamation-triangle me-2"></i> This event is full.
                    </div>
                    @elseif($event->start_date->isPast())
                    <div class="alert alert-custom">
                        <i class="fas fa-exclamation-triangle me-2"></i> This event has already ended.
                    </div>
                    @elseif(auth()->check() && $event->registrations()->where('user_id', auth()->id())->exists())
                    <div class="alert alert-custom">
                        <i class="fas fa-check-circle me-2"></i> You are already registered for this event.
                    </div>
                    @elseif(auth()->check())
                    <form action="{{ route('registrations.store', $event) }}" method="POST">
                        @csrf
                        <div class="mb-4 text-center">
                            <p class="text-muted mb-1">Price per ticket</p>
                            <p class="registration-price">{{ $event->formatted_price }}</p>
                        </div>
                        <div class="mb-4 text-center">
                            <p class="text-muted mb-1">Remaining Spots</p>
                            <p class="registration-spots">{{ $event->remaining_capacity }} of {{ $event->capacity }}</p>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" 
                                    style="width: {{ (($event->capacity - $event->remaining_capacity) / $event->capacity) * 100 }}%; background: linear-gradient(90deg, var(--accent-start), var(--accent-end));" 
                                    aria-valuenow="{{ $event->remaining_capacity }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="{{ $event->capacity }}"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="ticket_quantity" class="form-label text-white">Number of Tickets</label>
                            <select class="form-select" id="ticket_quantity" name="ticket_quantity">
                                @for ($i = 1; $i <= min(5, $event->remaining_capacity); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-ticket-alt me-2"></i> Register Now
                        </button>
                    </form>
                    @else
                    <div class="p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-ticket-alt fa-3x text-primary mb-3"></i>
                            <h5 class="mb-3 text-white">Want to attend this event?</h5>
                            <p class="text-muted">Join our community to register for events, track your bookings, and connect with other participants.</p>
                        </div>
                        <div class="mb-4 text-center">
                            <p class="text-muted mb-1">Price per ticket</p>
                            <p class="registration-price">{{ $event->formatted_price }}</p>
                        </div>
                        <div class="mb-4 text-center">
                            <p class="text-muted mb-1">Remaining Spots</p>
                            <p class="registration-spots">{{ $event->remaining_capacity }} of {{ $event->capacity }}</p>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" 
                                    style="width: {{ (($event->capacity - $event->remaining_capacity) / $event->capacity) * 100 }}%; background: linear-gradient(90deg, var(--accent-start), var(--accent-end));" 
                                    aria-valuenow="{{ $event->remaining_capacity }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="{{ $event->capacity }}"></div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i> Log In to Register
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                <i class="fas fa-user-plus me-2"></i> Sign Up Now
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="event-detail-card mt-4 wow fadeInUp" data-wow-delay="0.4s">
                <div class="card-body p-4">
                    <h5 class="card-title">Organizer</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0 me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent-start), var(--accent-end)); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-tie fa-lg text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-white">{{ $event->organizer->name }}</h6>
                            <small class="text-muted">Event Organizer</small>
                        </div>
                    </div>
                    <p class="text-muted">Contact the organizer for any questions about this event.</p>
                </div>
            </div>
            
            <div class="event-detail-card mt-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card-body p-4">
                    <h5 class="card-title">Share This Event</h5>
                    <div class="d-flex justify-content-around mt-3">
                        <a href="#" class="social-share-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-share-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-share-btn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-share-btn"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize WOW.js for animations
    new WOW().init();
</script>
@endpush 