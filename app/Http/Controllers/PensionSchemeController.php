<?php

namespace App\Http\Controllers;

use App\Models\PensionScheme;
use Illuminate\Http\Request;

class PensionSchemeController extends Controller
{
    public function index()
    {
        $schemes = PensionScheme::latest()->paginate(10);
        return view('pension_schemes.index', compact('schemes'));
    }

    public function create()
    {
        return view('pension_schemes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scheme_name' => 'required|string|max:255',
            'scheme_code' => 'required|string|max:50|unique:pension_schemes,scheme_code',
            'scheme_type' => 'required|string|max:100',
            'provider_type' => 'required|string|max:100',
            'eligibility_criteria' => 'nullable|string',
            'monthly_benefit' => 'required|numeric|min:0',
            'status' => 'required|string|in:Active,Inactive,Draft',
        ]);

        PensionScheme::create($validated);

        return redirect()->route('pension-schemes.index')
                         ->with('success', 'Pension Scheme created successfully.');
    }

    public function edit(PensionScheme $pensionScheme)
    {
        return view('pension_schemes.edit', compact('pensionScheme'));
    }

    public function update(Request $request, PensionScheme $pensionScheme)
    {
        $validated = $request->validate([
            'scheme_name' => 'required|string|max:255',
            'scheme_code' => 'required|string|max:50|unique:pension_schemes,scheme_code,' . $pensionScheme->id,
            'scheme_type' => 'required|string|max:100',
            'provider_type' => 'required|string|max:100',
            'eligibility_criteria' => 'nullable|string',
            'monthly_benefit' => 'required|numeric|min:0',
            'status' => 'required|string|in:Active,Inactive,Draft',
        ]);

        $pensionScheme->update($validated);

        return redirect()->route('pension-schemes.index')
                         ->with('success', 'Pension Scheme updated successfully.');
    }

    public function destroy(PensionScheme $pensionScheme)
    {
        $pensionScheme->delete();

        return redirect()->route('pension-schemes.index')
                         ->with('success', 'Pension Scheme deleted successfully.');
    }
}