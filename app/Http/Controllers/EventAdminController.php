<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'type' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->location = $request->location;
        $event->capacity = $request->capacity;
        $event->type = $request->type;
        $event->category = $request->category;
        $event->is_published = false;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('asset/img'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement créé avec succès.');
    }

    // Valider (publier) un événement
    public function publish($id)
    {
        $event = Event::findOrFail($id);
        $event->is_published = true;
        $event->save();

        return redirect()->back()->with('success', 'Événement validé (publié) avec succès.');
    }

    // Désactiver un événement
    public function unpublish($id)
    {
        $event = Event::findOrFail($id);
        $event->is_published = false;
        $event->save();

        return redirect()->back()->with('success', 'Événement désactivé avec succès.');
    }

    // Supprimer un événement
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Événement supprimé avec succès.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'type' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->location = $request->location;
        $event->capacity = $request->capacity;
        $event->type = $request->type;
        $event->category = $request->category;

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($event->image && file_exists(public_path('asset/img/' . $event->image))) {
                unlink(public_path('asset/img/' . $event->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('asset/img'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement modifié avec succès.');
    }
}
