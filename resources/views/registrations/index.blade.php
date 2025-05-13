@extends('layouts.participant')

@section('dashboard-title', 'My Registrations')

@section('dashboard-content')
<div class="content-card mb-5">
    <div class="content-header">
        <h5>My Event Registrations</h5>
    </div>
    
    <div class="content-body no-padding">
        @if(session('success'))
            <div class="alert-custom alert-success mb-0 mx-4 mt-4">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ session('success') }}</span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert-custom alert-danger mb-0 mx-4 mt-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span>{{ session('error') }}</span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        @endif
        
        <div class="registration-history">
            @forelse($registrations as $registration)
            <div class="registration-item">
                <div class="registration-image">
                    @if($registration->event->image)
                        <img src="{{ asset('asset/img/' . $registration->event->image) }}" alt="{{ $registration->event->title }}">
                    @else
                        <div class="placeholder-image">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    @endif
                </div>
                <div class="registration-info">
                    <h5>{{ $registration->event->title }}</h5>
                    <div class="info-row">
                        <div class="info-item">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $registration->event->location }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-item">
                            <i class="fas fa-ticket-alt"></i>
                            <span>{{ $registration->ticket_quantity }} ticket(s) - {{ number_format($registration->total_price, 2) }} €</span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span>Registered on {{ $registration->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div class="status-badges">
                        <span class="badge status-{{ $registration->status }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                        <span class="badge payment-{{ $registration->payment_status }}">
                            {{ ucfirst($registration->payment_status) }}
                        </span>
                    </div>
                </div>
                <div class="registration-actions">
                    <a href="{{ route('registrations.show', $registration) }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-info-circle"></i> Details
                    </a>
                    @if($registration->payment_status === 'paid')
                        <a href="{{ route('participant.tickets.download', $registration) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download Ticket
                        </a>
                    @elseif($registration->payment_status === 'pending')
                        <a href="{{ route('payment.show', $registration) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-credit-card"></i> Complete Payment
                        </a>
                    @endif
                    @if($registration->status !== 'cancelled')
                        <form action="{{ route('registrations.cancel', $registration) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this registration?')">
                                <i class="fas fa-ban"></i> Cancel
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <p>You have no registrations</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary">Browse Events</a>
            </div>
            @endforelse
        </div>
        
        <div class="pagination-container">
            {{ $registrations->links() }}
        </div>
    </div>
</div>

<style>
/* Alert Styles */
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

.alert-danger {
    background: rgba(245, 54, 92, 0.1);
    color: #f5365c;
    border-left: 4px solid #f5365c;
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

/* Pagination Styles */
.pagination-container {
    padding: 1.5rem;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-item {
    margin: 0 0.25rem;
}

.page-link {
    display: block;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.1);
    color: #6259ca;
    text-decoration: none;
    transition: all 0.3s;
}

.page-link:hover {
    background: rgba(98, 89, 202, 0.1);
}

.page-item.active .page-link {
    background: #6259ca;
    color: white;
    border-color: #6259ca;
}

.page-item.disabled .page-link {
    color: #ccc;
    pointer-events: none;
}
</style>

<script>
    // Alert close functionality
    document.addEventListener('DOMContentLoaded', function() {
        const alertCloseButtons = document.querySelectorAll('.alert-close');
        alertCloseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const alert = this.closest('.alert-custom');
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 300);
            });
        });
    });
</script>
@endsection 