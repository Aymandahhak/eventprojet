@extends('layouts.app')

@section('styles')
<style>
    .event-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
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
    }
    
    .event-card .card-text {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.5;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3">
                @if(request('type'))
                    {{ request('type') }} Events
                @elseif(request('keyword'))
                    Search Results for: "{{ request('keyword') }}"
                @else
                    Search Results
                @endif
            </h1>
        </div>
        <div class="col-md-4">
            <form action="{{ route('events.search') }}" method="GET" class="d-flex">
                <input type="text" name="keyword" class="form-control me-2" placeholder="Search events..." value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('events.search') }}" method="GET" class="row g-3">
                        @if(request('keyword'))
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                        @endif
                        
                        <div class="col-md-4">
                            <label class="form-label">Event Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="Conference" {{ request('type') == 'Conference' ? 'selected' : '' }}>Conference</option>
                                <option value="Workshop" {{ request('type') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="Seminar" {{ request('type') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                <option value="Networking" {{ request('type') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                <option value="Training" {{ request('type') == 'Training' ? 'selected' : '' }}>Training</option>
                                <option value="Exhibition" {{ request('type') == 'Exhibition' ? 'selected' : '' }}>Exhibition</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">Filter Results</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                        <small>{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</small>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="far fa-clock text-primary me-2"></i>
                        <small>{{ \Carbon\Carbon::parse($event->start_date)->format('h:i A') }}</small>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        <small class="text-truncate">{{ $event->location }}</small>
                    </div>
                    
                    <div class="mb-3 border-top pt-3">
                        <p class="card-text mb-3" style="min-height: 60px;">
                            {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                        </p>
                        
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <i class="fas fa-users text-primary me-1"></i>
                                <small>{{ $event->registrations->count() }}/{{ $event->capacity }} participants</small>
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
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> No events found matching your search criteria.
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('events.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i> View All Events
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $events->appends(request()->query())->links() }}
    </div>
</div>
@endsection 