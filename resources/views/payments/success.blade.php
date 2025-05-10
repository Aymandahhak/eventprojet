@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-check-circle"></i> Registration Confirmed</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success fa-5x"></i>
                        </div>
                        <h3>Thank You!</h3>
                        <p class="lead">Your registration for <strong>{{ $registration->event->title }}</strong> has been confirmed.</p>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Registration Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Event:</strong> {{ $registration->event->title }}</p>
                                    <p><strong>Date:</strong> {{ $registration->event->start_date->format('M d, Y') }}</p>
                                    <p><strong>Time:</strong> {{ $registration->event->start_date->format('h:i A') }} - {{ $registration->event->end_date->format('h:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Ticket Quantity:</strong> {{ $registration->ticket_quantity ?? 1 }}</p>
                                    <p><strong>Ticket Code:</strong> {{ $registration->ticket_code }}</p>
                                    <p><strong>Status:</strong> <span class="badge bg-success">Confirmed</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> A confirmation email will be sent to your registered email address.
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('registrations.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> View My Registrations
                        </a>
                        <a href="{{ route('events.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar-alt"></i> Explore More Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 