<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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
        
        // Generate a unique ticket code if it doesn't exist
        if (!$registration->ticket_code) {
            $registration->ticket_code = strtoupper(substr(md5($registration->id . time()), 0, 8)) . '-' . $registration->id;
            $registration->save();
        }
        
        // Load the registration with the event and user data
        $registration->load(['event', 'user']);
        
        // View the ticket in browser if preview parameter is present
        if (request()->has('preview')) {
            return view('tickets.download', compact('registration'));
        }
        
        // Generate PDF with specific configuration
        $pdf = PDF::loadView('tickets.pdf', compact('registration'));
        
        // Set PDF options
        $pdf->setPaper('a4');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'dejavu sans',
            'dpi' => 150,
            'isPhpEnabled' => false
        ]);
        
        // Return a downloadable PDF
        return $pdf->download('billet-' . Str::slug($registration->event->title) . '-' . $registration->id . '.pdf');
    }
} 