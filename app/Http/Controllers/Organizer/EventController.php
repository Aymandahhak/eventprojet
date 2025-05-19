<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        Log::info('Starting event creation process');
        Log::info('Request data:', $request->all());

        try {
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

            Log::info('Validation passed. Validated data:', $validated);

            $validated['organizer_id'] = auth()->id();
            $validated['is_published'] = false;

            Log::info('User ID (organizer_id):', ['id' => auth()->id()]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('asset/img'), $imageName);
                $validated['image'] = $imageName;  // Store only the filename
                Log::info('Image uploaded:', ['path' => $validated['image']]);
            }

            $event = Event::create($validated);
            Log::info('Event created successfully:', ['event_id' => $event->id]);

            return redirect()->route('organizer.events')
                ->with('success', 'Événement créé avec succès');
        } catch (\Exception $e) {
            Log::error('Error creating event:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Une erreur est survenue lors de la création de l\'événement. Veuillez réessayer.');
        }
    }

    public function edit(Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

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
            // Delete old image if it exists
            if ($event->image) {
                $oldImagePath = public_path($event->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('asset/img'), $imageName);
            $validated['image'] = $imageName;
        }

        $event->update($validated);

        return redirect()->route('organizer.events')
            ->with('success', 'Événement mis à jour avec succès');
    }

    public function destroy(Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($event->image) {
            $oldImagePath = public_path($event->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $event->delete();

        return redirect()->route('organizer.events')
            ->with('success', 'Événement supprimé avec succès');
    }
} 