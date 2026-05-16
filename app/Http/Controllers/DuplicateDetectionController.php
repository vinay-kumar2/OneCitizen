<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\CitizenPension;
use App\Models\DuplicateLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DuplicateDetectionController extends Controller
{
    public function index()
    {
        $logs = DuplicateLog::with('citizen')->latest()->paginate(10);
        return view('duplicate_detection.index', compact('logs'));
    }

    public function scan(Request $request)
    {
        // Clear old pending logs to avoid duplicating the duplicate logs during repeated scans
        DuplicateLog::where('status', 'Pending Review')->delete();

        $duplicatesFound = 0;

        // Detection Rule 1: A single citizen assigned to multiple Active pension schemes
        $multiplePensions = CitizenPension::select('citizen_id')
            ->where('pension_status', 'Active')
            ->groupBy('citizen_id')
            ->havingRaw('COUNT(id) > 1')
            ->get();

        foreach ($multiplePensions as $assignment) {
            DuplicateLog::create([
                'citizen_id' => $assignment->citizen_id,
                'duplicate_type' => 'Multiple Schemes',
                'detection_reason' => 'Citizen is enrolled in multiple active pension schemes concurrently.',
                'status' => 'Pending Review',
            ]);
            $duplicatesFound++;
        }

        // Detection Rule 2: Multiple citizens sharing the same mobile number with active pensions
        // (Since Aadhaar is strictly unique at DB level, we use mobile sharing as fraud marker)
        $sharedMobiles = Citizen::select('mobile_number')
            ->whereHas('citizenPensions', function($q) {
                $q->where('pension_status', 'Active');
            })
            ->groupBy('mobile_number')
            ->havingRaw('COUNT(id) > 1')
            ->get();

        foreach ($sharedMobiles as $shared) {
            $citizensSharing = Citizen::where('mobile_number', $shared->mobile_number)
                ->whereHas('citizenPensions', function($q) {
                    $q->where('pension_status', 'Active');
                })->get();

            foreach ($citizensSharing as $citizen) {
                // Ensure we don't log the same citizen multiple times for the same issue in a single scan
                $exists = DuplicateLog::where('citizen_id', $citizen->id)
                    ->where('duplicate_type', 'Shared Mobile Number')
                    ->exists();

                if (!$exists) {
                    DuplicateLog::create([
                        'citizen_id' => $citizen->id,
                        'duplicate_type' => 'Shared Mobile Number',
                        'detection_reason' => 'Mobile number (' . $shared->mobile_number . ') is shared across multiple active pensioners.',
                        'status' => 'Pending Review',
                    ]);
                    $duplicatesFound++;
                }
            }
        }

        return redirect()->route('duplicate-detection.index')
                         ->with('success', 'Scan completed securely. Found ' . $duplicatesFound . ' potential duplicate/fraud cases.');
    }
}
