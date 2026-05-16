<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\CitizenPension;
use App\Models\PensionScheme;
use Illuminate\Http\Request;

class CitizenPensionController extends Controller
{
    public function index()
    {
        $assignments = CitizenPension::with(['citizen', 'pensionScheme'])->latest()->paginate(10);
        return view('citizen_pensions.index', compact('assignments'));
    }

    public function create()
    {
        $citizens = Citizen::all(['id', 'full_name', 'aadhaar_number']);
        $schemes = PensionScheme::where('status', 'Active')->get(['id', 'scheme_name', 'scheme_code']);
        return view('citizen_pensions.create', compact('citizens', 'schemes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'citizen_id' => 'required|exists:citizens,id',
            'pension_scheme_id' => 'required|exists:pension_schemes,id',
            'enrollment_number' => 'required|string|unique:citizen_pensions,enrollment_number',
            'enrollment_date' => 'required|date',
            'pension_start_date' => 'required|date',
            'pension_status' => 'required|string|in:Active,Pending,Suspended,Terminated',
            'remarks' => 'nullable|string',
        ]);

        CitizenPension::create($validated);

        return redirect()->route('citizen-pensions.index')
                         ->with('success', 'Pension assignment created successfully.');
    }

    public function edit(CitizenPension $citizenPension)
    {
        $citizens = Citizen::all(['id', 'full_name', 'aadhaar_number']);
        $schemes = PensionScheme::where('status', 'Active')->get(['id', 'scheme_name', 'scheme_code']);
        return view('citizen_pensions.edit', compact('citizenPension', 'citizens', 'schemes'));
    }

    public function update(Request $request, CitizenPension $citizenPension)
    {
        $validated = $request->validate([
            'citizen_id' => 'required|exists:citizens,id',
            'pension_scheme_id' => 'required|exists:pension_schemes,id',
            'enrollment_number' => 'required|string|unique:citizen_pensions,enrollment_number,' . $citizenPension->id,
            'enrollment_date' => 'required|date',
            'pension_start_date' => 'required|date',
            'pension_status' => 'required|string|in:Active,Pending,Suspended,Terminated',
            'remarks' => 'nullable|string',
        ]);

        $citizenPension->update($validated);

        return redirect()->route('citizen-pensions.index')
                         ->with('success', 'Pension assignment updated successfully.');
    }

    public function destroy(CitizenPension $citizenPension)
    {
        $citizenPension->delete();

        return redirect()->route('citizen-pensions.index')
                         ->with('success', 'Pension assignment deleted successfully.');
    }
}