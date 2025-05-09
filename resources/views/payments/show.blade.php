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
                    <h4 class="mb-0">Complete Payment</h4>
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
                            <h5>Payment Information</h5>
                            <p><strong>Amount:</strong> {{ $registration->event->formatted_price }}</p>
                            <p><strong>Registration Date:</strong> {{ $registration->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <form id="payment-form" action="{{ route('payment.process', $registration) }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_intent_id" id="payment-intent-id">

                        <div class="mb-3">
                            <label for="card-element" class="form-label">Credit or Debit Card</label>
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" class="invalid-feedback" role="alert"></div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="submit-button">
                                <i class="fas fa-credit-card"></i> Pay {{ $registration->event->formatted_price }}
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

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit-button');
    const clientSecret = '{{ $clientSecret }}';

    card.addEventListener('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
            displayError.style.display = 'block';
        } else {
            displayError.textContent = '';
            displayError.style.display = 'none';
        }
    });

    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        submitButton.disabled = true;

        try {
            const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: '{{ auth()->user()->name }}',
                        email: '{{ auth()->user()->email }}'
                    }
                }
            });

            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                errorElement.style.display = 'block';
                submitButton.disabled = false;
            } else {
                document.getElementById('payment-intent-id').value = paymentIntent.id;
                form.submit();
            }
        } catch (error) {
            console.error('Error:', error);
            submitButton.disabled = false;
        }
    });
</script>
@endpush
@endsection 