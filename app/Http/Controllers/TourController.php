<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Tour;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tours = Tour::query()
            ->with(['lead', 'unit.property'])
            ->when($request->string('status')->value(), fn ($q, $status) => $q->where('status', $status))
            ->orderBy('scheduled_at')
            ->paginate(15);

        return view('tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tours.create', $this->formData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Tour::create($this->validateData($request));

        return redirect()->route('tours.index')->with('status', 'Tour scheduled.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour): View
    {
        $tour->load(['lead', 'unit.property']);

        return view('tours.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour): View
    {
        return view('tours.edit', array_merge(['tour' => $tour], $this->formData()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour): RedirectResponse
    {
        $tour->update($this->validateData($request));

        return redirect()->route('tours.index')->with('status', 'Tour updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour): RedirectResponse
    {
        $tour->delete();

        return redirect()->route('tours.index')->with('status', 'Tour deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function formData(): array
    {
        return [
            'leads' => Lead::orderBy('name')->get(),
            'units' => Unit::with('property')->get(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'lead_id' => ['required', 'exists:leads,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', Rule::in(['scheduled', 'completed', 'cancelled', 'no_show'])],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
