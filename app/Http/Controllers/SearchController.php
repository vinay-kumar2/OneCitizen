<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\CitizenPension;
use App\Models\PensionScheme;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return view('search.index', [
                'results' => null,
                'query' => null
            ]);
        }

        // Search Citizens
        $citizens = Citizen::where('full_name', 'like', "%{$query}%")
            ->orWhere('aadhaar_number', 'like', "%{$query}%")
            ->orWhere('mobile_number', 'like', "%{$query}%")
            ->orWhere('state', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Pension Schemes
        $schemes = PensionScheme::where('scheme_name', 'like', "%{$query}%")
            ->orWhere('scheme_code', 'like', "%{$query}%")
            ->orWhere('scheme_type', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Citizen Pensions
        $assignments = CitizenPension::where('enrollment_number', 'like', "%{$query}%")
            ->with(['citizen', 'pensionScheme'])
            ->limit(10)
            ->get();

        $totalResults = $citizens->count() + $schemes->count() + $assignments->count();

        return view('search.index', [
            'results' => [
                'citizens' => $citizens,
                'schemes' => $schemes,
                'assignments' => $assignments,
            ],
            'totalResults' => $totalResults,
            'query' => $query
        ]);
    }
}