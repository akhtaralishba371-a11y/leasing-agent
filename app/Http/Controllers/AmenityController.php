<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AmenityController extends Controller
{
    public function index(): View
    {
        $amenities = Amenity::query()->withCount('properties')->orderBy('name')->paginate(20);

        return view('amenities.index', compact('amenities'));
    }

    public function create(): View
    {
        return view('amenities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Amenity::create($this->validateData($request));

        return redirect()->route('amenities.index')->with('status', 'Amenity created.');
    }

    public function edit(Amenity $amenity): View
    {
        return view('amenities.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity): RedirectResponse
    {
        $amenity->update($this->validateData($request));

        return redirect()->route('amenities.index')->with('status', 'Amenity updated.');
    }

    public function destroy(Amenity $amenity): RedirectResponse
    {
        $amenity->delete();

        return redirect()->route('amenities.index')->with('status', 'Amenity deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
    }
}
