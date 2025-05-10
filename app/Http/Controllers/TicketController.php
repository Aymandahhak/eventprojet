<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use PDF;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets for the authenticated participant.
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = Registration::with('event')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('tickets.index', compact('tickets'));
    }
    
    /**
     * Download a ticket for a specific registration.
     */
    public function download(Registration $registration)
    {
        // Check if the authenticated user owns this ticket
        if (Auth::id() !== $registration->user_id) {
            return redirect()->route('participant.tickets')
                ->with('error', 'Vous n\'êtes pas autorisé à télécharger ce billet.');
        }
        
        // For now, just return a view with the ticket information
        // In a real application, you would generate a PDF here
        return view('tickets.download', compact('registration'));
        
        // Example of PDF generation (requires laravel-dompdf or similar)
        // $pdf = PDF::loadView('tickets.pdf', compact('registration'));
        // return $pdf->download('ticket-' . $registration->id . '.pdf');
    }
} 