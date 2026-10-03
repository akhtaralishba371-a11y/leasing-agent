<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sources = [
            'inquiry' => 'website property detail',
            'review' => 'website property review',
            'agent' => 'leasing agent application',
        ];

        $type = $request->string('type')->value();

        $leads = Lead::query()
            ->when($request->string('status')->value(), fn ($q, $status) => $q->where('status', $status))
            ->when(isset($sources[$type]), fn ($q) => $q->where('source', $sources[$type]))
            ->when($type === 'manual', fn ($q) => $q->where(function ($q) use ($sources) {
                $q->whereNotIn('source', array_values($sources))->orWhereNull('source');
            }))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'all' => Lead::count(),
            'inquiry' => Lead::where('source', $sources['inquiry'])->count(),
            'review' => Lead::where('source', $sources['review'])->count(),
            'agent' => Lead::where('source', $sources['agent'])->count(),
            'manual' => Lead::where(function ($q) use ($sources) {
                $q->whereNotIn('source', array_values($sources))->orWhereNull('source');
            })->count(),
        ];

        return view('leads.index', compact('leads', 'counts', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Lead::create($this->validateData($request));

        return redirect()->route('leads.index')->with('status', 'Lead created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead): View
    {
        $lead->load('tours.unit', 'leases.unit');

        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead): View
    {
        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead): RedirectResponse
    {
        $lead->update($this->validateData($request));

        return redirect()->route('leads.index')->with('status', 'Lead updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();

        return redirect()->route('leads.index')->with('status', 'Lead deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:32'],
            'source' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['new', 'contacted', 'touring', 'applied', 'leased', 'lost'])],
            'desired_bedrooms' => ['nullable', 'integer', 'min:0', 'max:20'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'desired_move_in' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
