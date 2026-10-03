<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Lease;
use App\Models\Property;
use App\Models\Tour;
use App\Models\Unit;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with key stats.
     */
    public function index(): View
    {
        $stats = [
            'properties' => Property::count(),
            'units' => Unit::count(),
            'available_units' => Unit::where('status', 'available')->count(),
            'leads' => Lead::count(),
            'active_leases' => Lease::where('status', 'active')->count(),
            'upcoming_tours' => Tour::where('status', 'scheduled')
                ->where('scheduled_at', '>=', now())
                ->count(),
        ];

        $leadsByStatus = Lead::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $unitsByStatus = Unit::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $monthlyRevenue = (float) Lease::where('status', 'active')->sum('rent');

        $upcomingTours = Tour::with(['lead', 'unit.property'])
            ->where('status', 'scheduled')
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')
            ->take(5)
            ->get();

        $recentLeads = Lead::latest()->take(5)->get();

        return view('dashboard', compact(
            'stats',
            'leadsByStatus',
            'unitsByStatus',
            'monthlyRevenue',
            'upcomingTours',
            'recentLeads',
        ));
    }
}
