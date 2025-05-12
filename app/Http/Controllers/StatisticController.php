<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        // Statistiques principales
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $publishedEvents = Event::where('is_published', true)->count();
        $unpublishedEvents = Event::where('is_published', false)->count();
        $totalRegistrations = Registration::count();
        $totalRevenue = Registration::where('payment_status', 'paid')->sum('total_price');

        // Répartition des rôles des utilisateurs
        $userRoles = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        // Répartition des types d'événements (Présentiel / En ligne)
        $eventTypes = Event::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        // Nombre d'enregistrements par mois (pour graphique éventuel)
        $monthlyRegistrations = Registration::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.statistics.index', compact(
            'totalUsers',
            'totalEvents',
            'publishedEvents',
            'unpublishedEvents',
            'totalRegistrations',
            'totalRevenue',
            'userRoles',
            'eventTypes',
            'monthlyRegistrations'
        ));
    }
}
