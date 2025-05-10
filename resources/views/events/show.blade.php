@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $event->title }}</li>
                </ol>
            </nav>

            <h1 class="mb-4">{{ $event->title }}</h1>

            @if($event->image)
            <img src="{{ asset('asset/img/' . $event->image) }}" class="img-fluid rounded mb-4" alt="{{ $event->title }}">
            @endif

            <div class="card mb-4">
                <div class="card-body">
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
                                <span class="badge {{ $event->type === 'Présentiel' ? 'bg-success' : ($event->type === 'Virtuel' ? 'bg-info' : 'bg-warning') }} rounded-pill">
                                    {{ $event->type }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{ $event->description }}</p>
                </div>
            </div>

            @can('update', $event)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Event Management</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Event
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">
                                <i class="fas fa-trash"></i> Delete Event
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endcan
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Registration</h5>
                    @if($event->is_full)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> This event is full.
                    </div>
                    @elseif($event->start_date->isPast())
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> This event has already ended.
                    </div>
                    @elseif(auth()->check() && $event->registrations()->where('user_id', auth()->id())->exists())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> You are already registered for this event.
                    </div>
                    @elseif(auth()->check())
                    <form action="{{ route('registrations.store', $event) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <p class="h4">{{ $event->formatted_price }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remaining Spots</label>
                            <p class="h4">{{ $event->remaining_capacity }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="ticket_quantity" class="form-label">Number of Tickets</label>
                            <select class="form-select" id="ticket_quantity" name="ticket_quantity">
                                @for ($i = 1; $i <= min(5, $event->remaining_capacity); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-ticket-alt"></i> Register Now
                        </button>
                    </form>
                    @else
                    <div class="p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-ticket-alt fa-3x text-primary mb-3"></i>
                            <h5 class="mb-3">Want to attend this event?</h5>
                            <p>Join our community to register for events, track your bookings, and connect with other participants.</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <p class="h4">{{ $event->formatted_price }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remaining Spots</label>
                            <p class="h4">{{ $event->remaining_capacity }}</p>
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
            
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Organizer</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-tie fa-2x text-primary me-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $event->organizer->name }}</h6>
                            <small class="text-muted">Event Organizer</small>
                        </div>
                    </div>
                    <p>Contact the organizer for any questions about this event.</p>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Share This Event</h5>
                    <div class="d-flex justify-content-around mt-3">
                        <a href="#" class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-primary"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-outline-primary"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="btn btn-outline-primary"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 