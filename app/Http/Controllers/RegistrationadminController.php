<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationadminController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['event', 'user'])->get();
        return view('admin.registrations.index', compact('registrations'));
    }

    public function validateRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->status = 'confirmed';
        $registration->save();

        return redirect()->back()->with('success', 'Inscription validée avec succès.');
    }

    public function deactivateRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->status = 'cancelled';
        $registration->save();

        return redirect()->back()->with('success', 'Inscription désactivée.');
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return redirect()->back()->with('success', 'Inscription supprimée.');
    }
}
