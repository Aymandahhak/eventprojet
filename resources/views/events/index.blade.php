@extends('layouts.app')

@section('styles')
<style>
    .event-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .event-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 15px 35px rgba(var(--accent-end-rgb), 0.25) !important;
        border-color: var(--accent-end);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .event-card .badge {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .event-card .card-title {
        font-size: 1.25rem;
        line-height: 1.4;
        color: var(--text-white);
    }
    
    .event-card .card-text {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .event-filter {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }

    .event-filter .form-label {
        color: var(--text-white);
        font-weight: 500;
    }

    .section-title {
        position: relative;
        margin-bottom: 3rem;
        padding-bottom: 1rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-start), var(--accent-end));
    }

    .page-header {
        padding: 3rem 0;
        margin-bottom: 2rem;
        background-color: rgba(10, 15, 31, 0.5);
        backdrop-filter: blur(5px);
        border-bottom: 1px solid var(--border-color);
    }

    .event-search-input {
        border-radius: 30px;
        padding-left: 1.2rem;
    }
    
    .event-search-button {
        border-radius: 0 30px 30px 0;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 mb-3">Discover Events</h1>
                <p class="text-muted">Browse upcoming events and join the ones that interest you.</p>
            </div>
            @can('manage-events')
            <div class="col-lg-4 d-flex align-items-center justify-content-lg-end mt-3 mt-lg-0">
                <a href="{{ route('events.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Create Event
                </a>
            </div>
            @endcan
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- Event Filter -->
    <div class="event-filter wow fadeInUp" data-wow-delay="0.1s">
        <form action="{{ route('events.search') }}" method="GET">
            <div class="row g-3">
                <div class="col-lg-5 col-md-5">
                    <div class="input-group">
                        <input type="text" class="form-control event-search-input" placeholder="Search events..." name="keyword" value="{{ request()->keyword ?? '' }}">
                        <button class="btn btn-primary event-search-button" type="submit"><i class="fas fa-search me-1"></i> Search</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <select name="type" class="form-select">
                        <option value="">All Categories</option>
                        <option value="Conference" {{ request()->type == 'Conference' ? 'selected' : '' }}>Conference</option>
                        <option value="Workshop" {{ request()->type == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="Seminar" {{ request()->type == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                        <option value="Networking" {{ request()->type == 'Networking' ? 'selected' : '' }}>Networking</option>
                        <option value="Training" {{ request()->type == 'Training' ? 'selected' : '' }}>Training</option>
                        <option value="Exhibition" {{ request()->type == 'Exhibition' ? 'selected' : '' }}>Exhibition</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3">
                    <input type="date" class="form-control" name="date" value="{{ request()->date ?? '' }}" placeholder="Select Date">
                </div>
                <div class="col-lg-1 col-md-1">
                    <a href="{{ route('events.index') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Event Results -->
    <div class="section-title wow fadeInUp" data-wow-delay="0.2s">
        <h2 class="text-white">Upcoming Events</h2>
    </div>

    <div class="row g-4">
        @forelse($events as $event)
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="card h-100 event-card border-0 shadow-sm">
                <div class="position-relative overflow-hidden">
                    @if($event->image)
                        <img class="card-img-top" src="{{ asset('asset/img/' . $event->image) }}" alt="{{ $event->title }}">
                    @endif
                    <div class="position-absolute top-0 start-0 m-3">
                        <div class="badge bg-primary rounded-pill px-3 py-2">{{ $event->category }}</div>
                    </div>
                    <div class="position-absolute top-0 end-0 m-3">
                        <div class="badge bg-dark rounded-pill px-3 py-2">
                            {{ $event->type }}
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title mb-3 text-truncate fw-bold">{{ $event->title }}</h5>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="far fa-calendar-alt text-primary me-2"></i>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</small>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="far fa-clock text-primary me-2"></i>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($event->start_date)->format('h:i A') }}</small>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        <small class="text-muted text-truncate">{{ $event->location }}</small>
                    </div>
                    
                    <div class="mb-3 border-top pt-3 border-color">
                        <p class="card-text mb-3" style="min-height: 60px;">
                            {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                        </p>
                        
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <i class="fas fa-users text-primary me-1"></i>
                                <small class="text-muted">{{ $event->registrations->count() }}/{{ $event->capacity }} participants</small>
                            </div>
                            <div>
                                <small class="text-primary fw-bold">${{ number_format($event->price, 2) }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary">
                            <i class="fas fa-info-circle me-2"></i>View Details
                        </a>
                        @auth
                            @if(!$event->registrations()->where('user_id', auth()->id())->exists())
                                <form action="{{ route('registrations.store', $event) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="ticket_quantity" value="1">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-ticket-alt me-2"></i>Book Now
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-success w-100" disabled>
                                    <i class="fas fa-check-circle me-2"></i>Already Booked
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-ticket-alt me-2"></i>Book Now
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <div class="alert bg-light border-0">
                <i class="fas fa-info-circle me-2 text-primary"></i>
                No events found matching your criteria. Try adjusting your search or check back later.
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $events->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize WOW.js for animations
    new WOW().init();
</script>
@endpush