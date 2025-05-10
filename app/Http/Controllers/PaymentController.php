<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Registration $registration)
    {
        $this->authorize('view', $registration);

        if ($registration->payment_status === 'paid') {
            return redirect()->route('registrations.show', $registration)
                ->with('info', 'Payment already completed.');
        }

        return view('payments.show', [
            'registration' => $registration
        ]);
    }

    public function process(Request $request, Registration $registration)
    {
        $this->authorize('update', $registration);

        // Mock payment process - always successful for student project
        $registration->update([
            'payment_status' => 'paid',
            'payment_id' => 'MOCK-' . time() . '-' . rand(1000, 9999),
            'status' => 'confirmed'
        ]);

        return redirect()->route('registrations.show', $registration)
            ->with('success', 'Payment successful! Your registration is confirmed.');
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