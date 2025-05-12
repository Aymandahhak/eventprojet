<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventAdminController extends Controller
{
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
            public function index()
        {
            $events = \App\Models\Event::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.events.index', compact('events'));
        }

        

}
