<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Property;
use App\Support\PropertyFilter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(Request $request): View
    {
        $options = PropertyFilter::filterOptions();
        $amenities = Amenity::query()->orderBy('name')->get();

        $properties = Property::query()
            ->withCount('units')
            ->with(['amenities'])
            ->withMin(['units as min_rent' => fn ($q) => $q->where('status', 'available')], 'rent')
            ->tap(fn ($q) => PropertyFilter::apply($q, $request))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('properties.index', compact('properties', 'options', 'amenities'));
    }

    public function create(): View
    {
        $amenities = Amenity::query()->orderBy('name')->get();

        return view('properties.create', compact('amenities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $this->storeUploadedImage($request, $data);

        $property = Property::create($data);
        $property->amenities()->sync($request->input('amenities', []));

        return redirect()->route('properties.index')->with('status', 'Property created.');
    }

    public function show(Property $property): View
    {
        $property->load(['units', 'amenities']);

        return view('properties.show', compact('property'));
    }

    public function edit(Property $property): View
    {
        $property->load('amenities');
        $amenities = Amenity::query()->orderBy('name')->get();

        return view('properties.edit', compact('property', 'amenities'));
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        $data = $this->validateData($request);
        $this->storeUploadedImage($request, $data, $property);

        $property->update($data);
        $property->amenities()->sync($request->input('amenities', []));

        return redirect()->route('properties.index')->with('status', 'Property updated.');
    }

    public function destroy(Property $property): RedirectResponse
    {
        $property->delete();

        return redirect()->route('properties.index')->with('status', 'Property deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'property_type' => ['nullable', 'string', 'in:'.implode(',', array_keys(PropertyFilter::TYPES))],
            'neighborhood' => ['nullable', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:64'],
            'zip' => ['required', 'string', 'max:16'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['integer', 'exists:amenities,id'],
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }

    /**
     * @param array<string, mixed> $data
     */
    private function storeUploadedImage(Request $request, array &$data, ?Property $property = null): void
    {
        unset($data['image']);

        if (! $request->hasFile('image')) {
            return;
        }

        $path = $request->file('image')->store('properties', 'public');
        $data['image_url'] = '/storage/'.$path;

        if ($property?->image_url && str_starts_with($property->image_url, '/storage/properties/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $property->image_url));
        }
    }
}
