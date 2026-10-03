<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Lead;
use App\Models\Property;
use App\Support\PropertyFilter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function index(): View
    {
        $featured = Property::query()
            ->where('is_published', true)
            ->with(['units' => fn ($q) => $q->where('status', 'available'), 'amenities'])
            ->withMin(['units as min_rent' => fn ($q) => $q->where('status', 'available')], 'rent')
            ->withMax(['units as max_bedrooms' => fn ($q) => $q->where('status', 'available')], 'bedrooms')
            ->withMin(['units as min_bedrooms' => fn ($q) => $q->where('status', 'available')], 'bedrooms')
            ->latest()
            ->take(3)
            ->get();

        return view('website.index', compact('featured'));
    }

    public function properties(Request $request): View
    {
        $options = PropertyFilter::filterOptions();
        $amenities = Amenity::query()->orderBy('name')->get();

        $properties = Property::query()
            ->where('is_published', true)
            ->with(['amenities', 'units' => fn ($q) => $q->where('status', 'available')])
            ->withMin(['units as min_rent' => fn ($q) => $q->where('status', 'available')], 'rent')
            ->withMax(['units as max_bedrooms' => fn ($q) => $q->where('status', 'available')], 'bedrooms')
            ->withMin(['units as min_bedrooms' => fn ($q) => $q->where('status', 'available')], 'bedrooms')
            ->withMin(['units as min_available_on' => fn ($q) => $q->where('status', 'available')], 'available_on')
            ->tap(fn ($q) => PropertyFilter::apply($q, $request))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('website.properties', compact('properties', 'options', 'amenities'));
    }

    public function property(Property $property): View
    {
        abort_unless($property->is_published, 404);

        $property->load([
            'amenities',
            'units' => fn ($q) => $q->where('status', 'available')->orderBy('rent'),
        ]);

        $property->loadMin(['units as min_rent' => fn ($q) => $q->where('status', 'available')], 'rent');
        $property->loadMax(['units as max_bedrooms' => fn ($q) => $q->where('status', 'available')], 'bedrooms');
        $property->loadMin(['units as min_bedrooms' => fn ($q) => $q->where('status', 'available')], 'bedrooms');
        $property->loadMin(['units as min_available_on' => fn ($q) => $q->where('status', 'available')], 'available_on');

        $related = Property::query()
            ->where('is_published', true)
            ->whereKeyNot($property->id)
            ->withMin(['units as min_rent' => fn ($q) => $q->where('status', 'available')], 'rent')
            ->latest()
            ->take(3)
            ->get();

        return view('website.property-detail', compact('property', 'related'));
    }

    public function propertyInquiry(Request $request, Property $property): \Illuminate\Http\RedirectResponse
    {
        abort_unless($property->is_published, 404);

        $data = $request->validateWithBag('inquiry', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:32'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        Lead::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'source' => 'website property detail',
            'status' => 'new',
            'notes' => trim("Property: {$property->name}\nAddress: {$property->address}\n\nMessage:\n".($data['message'] ?? '')),
        ]);

        return back()->with('inquiry_status', 'Thanks! Your inquiry has been sent to our leasing team.');
    }

    public function propertyReview(Request $request, Property $property): \Illuminate\Http\RedirectResponse
    {
        abort_unless($property->is_published, 404);

        $data = $request->validateWithBag('review', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'review' => ['required', 'string', 'max:5000'],
        ]);

        Lead::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'source' => 'website property review',
            'status' => 'new',
            'notes' => trim("Property: {$property->name}\nAddress: {$property->address}\nRating: {$data['rating']}/5\n\nReview:\n{$data['review']}"),
        ]);

        return back()->with('review_status', 'Thanks! Your review has been submitted.');
    }

    public function becomeAgentInquiry(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:32'],
            'preferred_area' => ['nullable', 'string', 'max:255'],
            'availability' => ['nullable', 'string', 'max:255'],
            'income_goal' => ['nullable', 'string', 'max:255'],
            'year_at_ut' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        Lead::create([
            'name' => trim($data['first_name'].' '.$data['last_name']),
            'email' => $data['email'],
            'phone' => $data['phone'],
            'source' => 'leasing agent application',
            'status' => 'new',
            'notes' => trim(
                "Leasing Agent Application\n".
                "Preferred Area: ".($data['preferred_area'] ?? '-')."\n".
                "Availability: ".($data['availability'] ?? '-')."\n".
                "Income Goal: ".($data['income_goal'] ?? '-')."\n".
                "Year at UT: ".($data['year_at_ut'] ?? '-')."\n\n".
                "Message:\n".($data['message'] ?? '')
            ),
        ]);

        return back()->with('agent_status', 'Thanks! Your application has been received. Our team will reach out soon.');
    }

    public function about(): View
    {
        return view('website.about');
    }

    public function agents(): View
    {
        return view('website.agents');
    }

    public function contact(): View
    {
        return view('website.contact');
    }

    public function becomeAgent(): View
    {
        return view('website.become-a-leasing-agent');
    }
}
