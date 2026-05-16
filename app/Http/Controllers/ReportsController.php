<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\PensionScheme;
use App\Models\CitizenPension;
use App\Models\DuplicateLog;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // 1. Total counts (Fast DB Counts)
        $totalCitizens = Citizen::count();
        $totalSchemes = PensionScheme::count();
        $totalAssignments = CitizenPension::count();
        $totalDuplicates = DuplicateLog::count();

        // 2. Specific Analytics
        $activeSchemes = PensionScheme::where('status', 'Active')->count();
        $pendingVerifications = Citizen::where('pension_status', 'Pending')->count();
        
        // Count unique citizens with active pensions natively through eloquent relationships
        $activeCitizens = Citizen::whereHas('citizenPensions', function($q) {
            $q->where('pension_status', 'Active');
        })->count();

        // Duplicate Detection rate percentage calculation
        $duplicateRate = $totalCitizens > 0 ? round(($totalDuplicates / $totalCitizens) * 100, 2) : 0;

        // 3. Recent duplicate records with eager loading for UI grid
        $recentDuplicates = DuplicateLog::with('citizen')
            ->latest()
            ->take(5)
            ->get();

        return view('reports.index', compact(
            'totalCitizens', 
            'totalSchemes', 
            'totalAssignments', 
            'totalDuplicates',
            'activeSchemes',
            'pendingVerifications',
            'activeCitizens',
            'duplicateRate',
            'recentDuplicates'
        ));
    }
}
