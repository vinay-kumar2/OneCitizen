<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    public function index()
    {
        $citizens = Citizen::latest()->paginate(10);
        return view('citizens.index', compact('citizens'));
    }

    public function create()
    {
        return view('citizens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'aadhaar_number' => 'required|string|size:12|unique:citizens,aadhaar_number',
            'mobile_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'state' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'pension_status' => 'required|string|in:Eligible,Not Eligible,Pending,Active',
        ]);

        Citizen::create($validated);

        return redirect()->route('citizens.index')
                         ->with('success', 'Citizen registered successfully.');
    }

    public function edit(Citizen $citizen)
    {
        return view('citizens.edit', compact('citizen'));
    }

    public function update(Request $request, Citizen $citizen)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'aadhaar_number' => 'required|string|size:12|unique:citizens,aadhaar_number,' . $citizen->id,
            'mobile_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'state' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'pension_status' => 'required|string|in:Eligible,Not Eligible,Pending,Active',
        ]);

        $citizen->update($validated);

        return redirect()->route('citizens.index')
                         ->with('success', 'Citizen updated successfully.');
    }

    public function destroy(Citizen $citizen)
    {
        $citizen->delete();

        return redirect()->route('citizens.index')
                         ->with('success', 'Citizen deleted successfully.');
    }
}