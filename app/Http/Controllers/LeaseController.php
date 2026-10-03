<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Lease;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $leases = Lease::query()
            ->with(['lead', 'unit.property'])
            ->when($request->string('status')->value(), fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        return view('leases.index', compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('leases.create', $this->formData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Lease::create($this->validateData($request));

        return redirect()->route('leases.index')->with('status', 'Lease created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease): View
    {
        $lease->load(['lead', 'unit.property']);

        return view('leases.show', compact('lease'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease): View
    {
        return view('leases.edit', array_merge(['lease' => $lease], $this->formData()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lease $lease): RedirectResponse
    {
        $lease->update($this->validateData($request));

        return redirect()->route('leases.index')->with('status', 'Lease updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease): RedirectResponse
    {
        $lease->delete();

        return redirect()->route('leases.index')->with('status', 'Lease deleted.');
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
            'unit_id' => ['required', 'exists:units,id'],
            'lead_id' => ['required', 'exists:leads,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'rent' => ['required', 'numeric', 'min:0'],
            'deposit' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['pending', 'active', 'ended', 'terminated'])],
            'signed_at' => ['nullable', 'date'],
        ]);
    }
}
