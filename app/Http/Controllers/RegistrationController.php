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
        $registrations = Auth::user()->registrations()
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->get();
            
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
        
        // Préparation des données d'inscription
        $registrationData = [
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'status' => 'confirmed',
            'ticket_number' => Registration::generateTicketNumber(),
            'attended' => false
        ];
        
        // Gestion du paiement
        if (!$event->is_free) {
            $registrationData['payment_status'] = 'en attente';
            $registrationData['amount_paid'] = $event->price;
            
            // Si un paiement est nécessaire, on peut rediriger vers une page de paiement
            // Pour l'instant, on simule que le paiement est effectué
            $registrationData['payment_status'] = 'payé';
            $registrationData['payment_method'] = 'carte bancaire';
            $registrationData['payment_id'] = 'PAY-' . strtoupper(substr(uniqid(), -8));
        } else {
            $registrationData['payment_status'] = 'gratuit';
            $registrationData['amount_paid'] = 0;
        }
        
        // Création de l'inscription
        $registration = Registration::create($registrationData);
        
        // Envoi d'un email de confirmation (à implémenter)
        // Mail::to(Auth::user()->email)->send(new RegistrationConfirmation($registration));
        
        return redirect()->route('registrations.show', $registration)
            ->with('success', 'Votre inscription a été confirmée avec succès !');
    }

    /**
     * Display the specified registration.
     */
    public function show(Registration $registration)
    {
        // Vérifie si l'utilisateur est bien le propriétaire de l'inscription
        if (Auth::id() !== $registration->user_id && !Auth::user()->isAdmin()) {
            return redirect()->route('registrations.index')
                ->with('error', 'Vous n\'avez pas l\'autorisation de voir cette inscription.');
        }
        
        return view('registrations.show', compact('registration'));
    }

    /**
     * Cancel the specified registration.
     */
    public function cancel(Registration $registration)
    {
        // Vérifie si l'utilisateur est bien le propriétaire de l'inscription
        if (Auth::id() !== $registration->user_id && !Auth::user()->isAdmin()) {
            return redirect()->route('registrations.index')
                ->with('error', 'Vous n\'avez pas l\'autorisation d\'annuler cette inscription.');
        }
        
        $registration->status = 'annulée';
        $registration->save();
        
        return redirect()->route('registrations.index')
            ->with('success', 'Votre inscription a été annulée avec succès.');
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
} 