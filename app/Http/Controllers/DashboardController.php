<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\PensionScheme;
use App\Models\CitizenPension;
use App\Models\DuplicateLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        // Get real statistics from database
        $totalCitizens = Citizen::count();
        $activeSchemes = PensionScheme::where('status', 'Active')->count();
        $totalAssignments = CitizenPension::count();
        $pendingAssignments = CitizenPension::where('pension_status', 'Pending')->count();
        $duplicateRecords = DuplicateLog::where('status', 'pending')->count();

        // Get recent activities (latest citizens added)
        $recentCitizens = Citizen::latest()->take(5)->get();

        // Get recent duplicate detections
        $recentDuplicates = DuplicateLog::with('citizen')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCitizens',
            'activeSchemes',
            'totalAssignments',
            'pendingAssignments',
            'duplicateRecords',
            'recentCitizens',
            'recentDuplicates'
        ));
    }
}