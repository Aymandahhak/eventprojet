@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.show', $registration->event) }}">{{ $registration->event->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Confirm Registration</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Event Information</h5>
                            <p><strong>Title:</strong> {{ $registration->event->title }}</p>
                            <p><strong>Date:</strong> {{ $registration->event->start_date->format('M d, Y') }}</p>
                            <p><strong>Time:</strong> {{ $registration->event->start_date->format('h:i A') }} - {{ $registration->event->end_date->format('h:i A') }}</p>
                            <p><strong>Location:</strong> {{ $registration->event->location }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Registration Information</h5>
                            <p><strong>Ticket Quantity:</strong> {{ $registration->ticket_quantity ?? 1 }}</p>
                            <p><strong>Price per Ticket:</strong> {{ $registration->event->formatted_price }}</p>
                            <p><strong>Total Price:</strong> ${{ number_format($registration->total_price ?? $registration->event->price, 2) }}</p>
                            <p><strong>Registration Date:</strong> {{ $registration->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> This is a demo application. No actual payment will be processed.
                    </div>

                    <form action="{{ route('payment.process', $registration) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agree-terms" required>
                                <label class="form-check-label" for="agree-terms">
                                    I agree to the terms and conditions of this event
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check-circle"></i> Confirm Registration
                            </button>
                            <a href="{{ route('registrations.show', $registration) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 