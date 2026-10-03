<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $units = Unit::query()
            ->with('property')
            ->when($request->integer('property_id'), fn ($q, $id) => $q->where('property_id', $id))
            ->when($request->string('status')->value(), fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $properties = Property::orderBy('name')->get();

        return view('units.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Unit::create($this->validateData($request));

        return redirect()->route('units.index')->with('status', 'Unit created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit): View
    {
        $unit->load('property', 'tours.lead', 'leases.lead');

        return view('units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit): View
    {
        $properties = Property::orderBy('name')->get();

        return view('units.edit', compact('unit', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit): RedirectResponse
    {
        $unit->update($this->validateData($request));

        return redirect()->route('units.index')->with('status', 'Unit updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit): RedirectResponse
    {
        $unit->delete();

        return redirect()->route('units.index')->with('status', 'Unit deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'unit_number' => ['required', 'string', 'max:255'],
            'bedrooms' => ['required', 'integer', 'min:0', 'max:20'],
            'bathrooms' => ['required', 'numeric', 'min:0', 'max:20'],
            'square_feet' => ['nullable', 'integer', 'min:0'],
            'rent' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['available', 'leased', 'unavailable'])],
            'available_on' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
