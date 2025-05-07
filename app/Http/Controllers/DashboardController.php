<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'organizer':
                return redirect()->route('organizer.dashboard');
            default:
                return redirect()->route('participant.dashboard');
        }
    }
}