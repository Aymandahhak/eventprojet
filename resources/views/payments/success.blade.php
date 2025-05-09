@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-4x"></i>
                    </div>
                    <h2 class="card-title mb-4">Payment Successful!</h2>
                    <p class="card-text">Thank you for your payment. Your registration for <strong>{{ $registration->event->title }}</strong> has been confirmed.</p>
                    
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Registration Details</h5>
                        <p class="mb-0">
                            <strong>Event:</strong> {{ $registration->event->title }}<br>
                            <strong>Date:</strong> {{ $registration->event->start_date->format('M d, Y') }}<br>
                            <strong>Time:</strong> {{ $registration->event->start_date->format('h:i A') }} - {{ $registration->event->end_date->format('h:i A') }}<br>
                            <strong>Location:</strong> {{ $registration->event->location }}
                        </p>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('registrations.show', $registration) }}" class="btn btn-primary">
                            <i class="fas fa-ticket-alt"></i> View Registration Details
                        </a>
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-calendar"></i> Browse More Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 