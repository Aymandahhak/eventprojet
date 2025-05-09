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
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }
    
    /**
     * Affiche la liste des événements
     */
    public function index()
    {
        $events = Event::where('is_published', true)
            ->orderBy('start_date')
            ->paginate(12);
        
        return view('events.index', compact('events'));
    }

    /**
     * Affiche le formulaire de création d'un événement
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Enregistre un nouvel événement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['organizer_id'] = auth()->id();
        $validated['is_published'] = false;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('organizer.events')
            ->with('success', 'Event created successfully');
    }

    /**
     * Affiche les détails d'un événement
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Affiche le formulaire d'édition d'un événement
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        return view('events.edit', compact('event'));
    }

    /**
     * Met à jour un événement
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('organizer.events')
            ->with('success', 'Event updated successfully');
    }

    /**
     * Supprime un événement
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('organizer.events')
            ->with('success', 'Event deleted successfully');
    }

    public function organizerEvents()
    {
        $events = auth()->user()->organizedEvents()
            ->orderBy('start_date')
            ->paginate(10);

        return view('events.organizer-events', compact('events'));
    }

    public function participantEvents()
    {
        $events = auth()->user()->registeredEvents()
            ->orderBy('start_date')
            ->paginate(10);

        return view('events.participant-events', compact('events'));
    }

    /**
     * Search for events based on query parameters
     */
    public function search(Request $request)
    {
        $query = Event::query();
        
        // Search by keyword (name or description)
        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }
        
        // Filter by event type/category
        if ($request->has('type') && $request->type != 'Select Event Type') {
            $query->where('category', $request->type);
        }
        
        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->whereDate('date', $request->date);
        }
        
        $events = $query->paginate(10);
        
        return view('events.search', compact('events', 'request'));
    }
}