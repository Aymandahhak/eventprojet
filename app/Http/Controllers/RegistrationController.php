<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;

class RegistrationController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the registrations for the authenticated user.
     */
    public function index()
    {
        $registrations = auth()->user()->registrations()
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new registration.
     */
    public function create(Event $event)
    {
        // Vérifie si l'événement est complet
        if ($event->isFull()) {
            return redirect()->route('events.show', $event)
                ->with('error', 'Cet événement est complet, les inscriptions sont fermées.');
        }
        
        // Vérifie si l'utilisateur est déjà inscrit
        $existingRegistration = Registration::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->first();
            
        if ($existingRegistration) {
            return redirect()->route('events.show', $event)
                ->with('error', 'Vous êtes déjà inscrit à cet événement.');
        }
        
        return view('registrations.create', compact('event'));
    }

    /**
     * Store a newly created registration in storage.
     */
    public function store(Request $request, Event $event)
    {
        // Check if event is published
        if (!$event->is_published) {
            return back()->with('error', 'This event is not available for registration.');
        }

        // Check if event is full
        if ($event->registrations()->count() >= $event->capacity) {
            return back()->with('error', 'Sorry, this event is full.');
        }

        // Check if user is already registered
        if ($event->registrations()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You are already registered for this event.');
        }

        // Validate the quantity
        $request->validate([
            'ticket_quantity' => 'nullable|integer|min:1',
        ]);

        // Set default ticket quantity to 1 if not specified
        $ticketQuantity = $request->ticket_quantity ?? 1;
        
        // Calculate total price
        $totalPrice = $event->price * $ticketQuantity;
        
        // Generate a unique ticket code
        $ticketCode = 'EVT-' . strtoupper(substr(md5(uniqid()), 0, 8)) . '-' . auth()->id();

        // Create registration
        $registration = $event->registrations()->create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'payment_status' => 'pending',
            'ticket_quantity' => $ticketQuantity,
            'total_price' => $totalPrice,
            'ticket_code' => $ticketCode
        ]);

        // Redirect to payment page
        return redirect()->route('payment.show', $registration)
            ->with('success', 'Registration successful! Please complete your payment.');
    }

    /**
     * Display the specified registration.
     */
    public function show(Registration $registration)
    {
        $this->authorize('view', $registration);
        return view('registrations.show', compact('registration'));
    }

    /**
     * Cancel the specified registration.
     */
    public function cancel(Registration $registration)
    {
        $this->authorize('update', $registration);

        if ($registration->status === 'cancelled') {
            return back()->with('error', 'This registration is already cancelled.');
        }

        $registration->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Registration cancelled successfully.');
    }

    /**
     * Download ticket as PDF.
     */
    public function downloadTicket(Registration $registration)
    {
        // Vérifie si l'utilisateur est bien le propriétaire de l'inscription
        if (Auth::id() !== $registration->user_id && !Auth::user()->isAdmin()) {
            return redirect()->route('registrations.index')
                ->with('error', 'Vous n\'avez pas l\'autorisation de télécharger ce billet.');
        }
        
        // Génération du PDF du billet (à implémenter)
        // $pdf = PDF::loadView('tickets.pdf', compact('registration'));
        
        // Pour l'instant, redirige vers la page de l'inscription
        return redirect()->route('registrations.show', $registration)
            ->with('info', 'La fonctionnalité de téléchargement de billet sera disponible prochainement.');
    }

    public function organizerRegistrations(Event $event)
    {
        $this->authorize('view', $event);

        $registrations = $event->registrations()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('registrations.organizer-registrations', compact('event', 'registrations'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $this->authorize('update', $registration);

        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        $registration->update($validated);

        return back()->with('success', 'Registration status updated successfully.');
    }

    public function organizerAllRegistrations()
    {
        $registrations = Registration::whereHas('event', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['event', 'user'])->latest()->paginate(10);

        return view('organizer.registrations.index', compact('registrations'));
    }

    /**
     * Confirm a registration
     */
    public function confirm(Registration $registration)
    {
        // Check if the authenticated user is the organizer of the event
        $this->authorize('update', $registration->event);

        if ($registration->status !== 'pending') {
            return back()->with('error', 'Cette inscription ne peut pas être confirmée.');
        }

        $registration->update([
            'status' => 'confirmed'
        ]);

        // You might want to send an email to the user here
        // Mail::to($registration->user->email)->send(new RegistrationConfirmed($registration));

        return back()->with('success', 'Inscription confirmée avec succès.');
    }

    /**
     * Reject a registration
     */
    public function reject(Registration $registration)
    {
        // Check if the authenticated user is the organizer of the event
        $this->authorize('update', $registration->event);

        if ($registration->status !== 'pending') {
            return back()->with('error', 'Cette inscription ne peut pas être rejetée.');
        }

        $registration->update([
            'status' => 'rejected'
        ]);

        // You might want to send an email to the user here
        // Mail::to($registration->user->email)->send(new RegistrationRejected($registration));

        return back()->with('success', 'Inscription rejetée.');
    }
} 