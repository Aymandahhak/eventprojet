<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        // Récupérer les inscriptions pour les événements de l'organisateur connecté
        $registrations = Registration::whereHas('event', function($query) {
            $query->where('organizer_id', auth()->id());
        })
        ->with(['event', 'user'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('organizer.registrations.index', compact('registrations'));
    }

    public function destroy($id)
    {
        $registration = Registration::whereHas('event', function($query) {
            $query->where('organizer_id', auth()->id());
        })->findOrFail($id);

        $registration->delete();

        return redirect()->back()->with('success', 'Inscription supprimée.');
    }
} 