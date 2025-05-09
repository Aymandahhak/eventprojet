<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function show(Registration $registration)
    {
        $this->authorize('view', $registration);

        if ($registration->payment_status === 'paid') {
            return redirect()->route('registrations.show', $registration)
                ->with('info', 'Payment already completed.');
        }

        // Set your secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Create a PaymentIntent
        $paymentIntent = PaymentIntent::create([
            'amount' => $registration->event->price * 100, // amount in cents
            'currency' => 'usd',
            'metadata' => [
                'registration_id' => $registration->id
            ]
        ]);

        return view('payments.show', [
            'registration' => $registration,
            'clientSecret' => $paymentIntent->client_secret
        ]);
    }

    public function process(Request $request, Registration $registration)
    {
        $this->authorize('update', $registration);

        $validated = $request->validate([
            'payment_intent_id' => 'required|string'
        ]);

        // Set your secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Retrieve the PaymentIntent
        $paymentIntent = PaymentIntent::retrieve($validated['payment_intent_id']);

        if ($paymentIntent->status === 'succeeded') {
            $registration->update([
                'payment_status' => 'paid',
                'payment_id' => $paymentIntent->id,
                'status' => 'confirmed'
            ]);

            return redirect()->route('registrations.show', $registration)
                ->with('success', 'Payment successful! Your registration is confirmed.');
        }

        return back()->with('error', 'Payment failed. Please try again.');
    }

    public function success(Registration $registration)
    {
        $this->authorize('view', $registration);

        return view('payments.success', compact('registration'));
    }

    public function cancel(Registration $registration)
    {
        $this->authorize('update', $registration);

        $registration->update([
            'status' => 'cancelled',
            'payment_status' => 'cancelled'
        ]);

        return redirect()->route('events.show', $registration->event)
            ->with('info', 'Payment cancelled. You can try again later.');
    }
} 