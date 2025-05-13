@extends('layouts.participant')

@section('dashboard-title', 'Registration Details')

@section('dashboard-content')
<div class="content-card mb-5">
    <div class="content-header">
        <h5>Registration Details</h5>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('participant.tickets.download', $registration) }}" class="btn btn-primary">
                <i class="fas fa-download"></i> Download Ticket
            </a>
        </div>
    </div>
    
    <div class="content-body">
        @if(session('success'))
            <div class="alert-custom alert-success mb-4">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ session('success') }}</span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert-custom alert-danger mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span>{{ session('error') }}</span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        @endif
        
        <div class="ticket-details">
            <div class="ticket-card">
                <div class="ticket-header">
                    <div class="ticket-logo">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="ticket-code">
                        {{ $registration->ticket_code }}
                    </div>
                </div>
                
                <div class="ticket-body">
                    <div class="event-info">
                        <h4>{{ $registration->event->title }}</h4>
                        <div class="event-meta">
                            <div><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }}</div>
                            <div><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}</div>
                            <div><i class="fas fa-map-marker-alt"></i> {{ $registration->event->location }}</div>
                        </div>
                    </div>
                    
                    <div class="ticket-info">
                        <div class="info-item">
                            <span class="label">Attendee</span>
                            <span class="value">{{ $registration->user->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Email</span>
                            <span class="value">{{ $registration->user->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Ticket Quantity</span>
                            <span class="value">{{ $registration->ticket_quantity }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Total Price</span>
                            <span class="value">{{ number_format($registration->total_price, 2) }} €</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Registration Date</span>
                            <span class="value">{{ $registration->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Status</span>
                            <span class="value status-{{ $registration->status }}">{{ ucfirst($registration->status) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Payment Status</span>
                            <span class="value payment-{{ $registration->payment_status }}">{{ ucfirst($registration->payment_status) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="ticket-footer">
                    <div class="qr-code">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $registration->ticket_code }}" alt="QR Code">
                    </div>
                    <div class="ticket-actions">
                        @if($registration->status !== 'cancelled')
                            <form action="{{ route('registrations.cancel', $registration) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this registration?')">
                                    <i class="fas fa-ban"></i> Cancel Registration
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ticket-details {
        padding: 1rem 0;
    }
    
    .ticket-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #6259ca 0%, #8a79fa 100%);
        color: white;
    }
    
    .ticket-logo {
        font-size: 2.5rem;
    }
    
    .ticket-code {
        font-size: 1.25rem;
        font-weight: bold;
        letter-spacing: 1px;
        padding: 0.5rem 1rem;
        background: rgba(255,255,255,0.2);
        border-radius: 8px;
    }
    
    .ticket-body {
        padding: 2rem;
        border-bottom: 1px dashed rgba(0,0,0,0.1);
    }
    
    .event-info {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .event-info h4 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        color: #666;
    }
    
    .event-meta div {
        display: flex;
        align-items: center;
    }
    
    .event-meta i {
        margin-right: 0.5rem;
        color: #6259ca;
    }
    
    .ticket-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
    }
    
    .label {
        font-size: 0.875rem;
        color: #888;
        margin-bottom: 0.25rem;
    }
    
    .value {
        font-weight: 600;
        color: #333;
    }
    
    .status-confirmed, .payment-paid {
        color: #2dce89;
    }
    
    .status-pending, .payment-pending {
        color: #fb6340;
    }
    
    .status-cancelled {
        color: #f5365c;
    }
    
    .ticket-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem;
        background: rgba(0,0,0,0.02);
    }
    
    .ticket-actions {
        display: flex;
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .ticket-info {
            grid-template-columns: 1fr;
        }
        
        .ticket-footer {
            flex-direction: column;
            gap: 1.5rem;
        }
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