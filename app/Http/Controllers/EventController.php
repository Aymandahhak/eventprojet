<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    
    /**
     * Affiche la liste des événements
     */
    public function index()
    {
        $events = Event::where('status', 'published')
            ->orderBy('date', 'asc')
            ->get();
        
        return view('events.index', compact('events'));
    }

    /**
     * Affiche le formulaire de création d'un événement
     */
    public function create()
    {
        // Vérifie si l'utilisateur est un organisateur
        if (!Auth::user()->isOrganizer()) {
            return redirect()->route('events.index')
                ->with('error', 'Vous n\'avez pas l\'autorisation de créer un événement.');
        }
        
        $categories = ['Conférence', 'Séminaire', 'Formation', 'Atelier', 'Webinaire', 'Autre'];
        $types = ['Présentiel', 'Virtuel', 'Hybride'];
        
        return view('events.create', compact('categories', 'types'));
    }

    /**
     * Enregistre un nouvel événement
     */
    public function store(Request $request)
    {
        // Vérifie si l'utilisateur est un organisateur
        if (!Auth::user()->isOrganizer()) {
            return redirect()->route('events.index')
                ->with('error', 'Vous n\'avez pas l\'autorisation de créer un événement.');
        }
        
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'location_details' => 'nullable|string',
            'category' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'max_participants' => 'nullable|integer|min:1',
            'is_free' => 'boolean',
            'price' => 'required_if:is_free,0|nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        } else {
            $validated['image'] = 'asset/img/default-event.jpg';
        }
        
        // Ajout des données supplémentaires
        $validated['organizer_id'] = Auth::id();
        $validated['status'] = 'published';
        
        // Création de l'événement
        $event = Event::create($validated);
        
        return redirect()->route('events.show', $event)
            ->with('success', 'Événement créé avec succès !');
    }

    /**
     * Affiche les détails d'un événement
     */
    public function show(Event $event)
    {
        // Récupération des événements similaires
        $similarEvents = Event::where('category', $event->category)
            ->where('id', '!=', $event->id)
            ->where('status', 'published')
            ->take(3)
            ->get();
            
        return view('events.show', compact('event', 'similarEvents'));
    }

    /**
     * Affiche le formulaire d'édition d'un événement
     */
    public function edit(Event $event)
    {
        // Vérifie si l'utilisateur est l'organisateur ou un admin
        if (Auth::id() !== $event->organizer_id && !Auth::user()->isAdmin()) {
            return redirect()->route('events.show', $event)
                ->with('error', 'Vous n\'avez pas l\'autorisation de modifier cet événement.');
        }
        
        $categories = ['Conférence', 'Séminaire', 'Formation', 'Atelier', 'Webinaire', 'Autre'];
        $types = ['Présentiel', 'Virtuel', 'Hybride'];
        
        return view('events.edit', compact('event', 'categories', 'types'));
    }

    /**
     * Met à jour un événement
     */
    public function update(Request $request, Event $event)
    {
        // Vérifie si l'utilisateur est l'organisateur ou un admin
        if (Auth::id() !== $event->organizer_id && !Auth::user()->isAdmin()) {
            return redirect()->route('events.show', $event)
                ->with('error', 'Vous n\'avez pas l\'autorisation de modifier cet événement.');
        }
        
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'location_details' => 'nullable|string',
            'category' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'max_participants' => 'nullable|integer|min:1',
            'is_free' => 'boolean',
            'price' => 'required_if:is_free,0|nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,cancelled',
        ]);
        
        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe et n'est pas l'image par défaut
            if ($event->image && $event->image !== 'asset/img/default-event.jpg' && Storage::exists(str_replace('storage/', 'public/', $event->image))) {
                Storage::delete(str_replace('storage/', 'public/', $event->image));
            }
            
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }
        
        // Mise à jour de l'événement
        $event->update($validated);
        
        return redirect()->route('events.show', $event)
            ->with('success', 'Événement mis à jour avec succès !');
    }

    /**
     * Supprime un événement
     */
    public function destroy(Event $event)
    {
        // Vérifie si l'utilisateur est l'organisateur ou un admin
        if (Auth::id() !== $event->organizer_id && !Auth::user()->isAdmin()) {
            return redirect()->route('events.show', $event)
                ->with('error', 'Vous n\'avez pas l\'autorisation de supprimer cet événement.');
        }
        
        // Supprime l'image si elle existe et n'est pas l'image par défaut
        if ($event->image && $event->image !== 'asset/img/default-event.jpg' && Storage::exists(str_replace('storage/', 'public/', $event->image))) {
            Storage::delete(str_replace('storage/', 'public/', $event->image));
        }
        
        $event->delete();
        
        return redirect()->route('events.index')
            ->with('success', 'Événement supprimé avec succès !');
    }
}