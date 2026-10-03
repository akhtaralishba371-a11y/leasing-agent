<?php

namespace App\Support;

use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PropertyFilter
{
    public const TYPES = [
        'loft' => 'Loft',
        'apartment' => 'Apartment',
        'house' => 'House',
        'exclusive' => 'Tower Exclusive',
    ];

    /**
     * @return Builder<Property>
     */
    public static function apply(Builder $query, Request $request): Builder
    {
        return $query
            ->when($request->filled('city'), fn (Builder $q) => $q->where('city', $request->string('city')))
            ->when($request->filled('property_type'), fn (Builder $q) => $q->where('property_type', $request->string('property_type')))
            ->when($request->filled('beds'), function (Builder $q) use ($request) {
                $beds = $request->integer('beds');
                $q->whereHas('units', fn (Builder $u) => $u
                    ->where('status', 'available')
                    ->where('bedrooms', '>=', $beds));
            })
            ->when($request->filled('baths'), function (Builder $q) use ($request) {
                $baths = (float) $request->input('baths');
                $q->whereHas('units', fn (Builder $u) => $u
                    ->where('status', 'available')
                    ->where('bathrooms', '>=', $baths));
            })
            ->when($request->filled('min_price') || $request->filled('max_price'), function (Builder $q) use ($request) {
                $min = $request->input('min_price');
                $max = $request->input('max_price');
                $q->whereHas('units', function (Builder $u) use ($min, $max) {
                    $u->where('status', 'available');
                    if ($min !== null && $min !== '') {
                        $u->where('rent', '>=', (float) $min);
                    }
                    if ($max !== null && $max !== '') {
                        $u->where('rent', '<=', (float) $max);
                    }
                });
            })
            ->when($request->filled('amenities'), function (Builder $q) use ($request) {
                $ids = array_filter((array) $request->input('amenities'));
                foreach ($ids as $id) {
                    $q->whereHas('amenities', fn (Builder $a) => $a->where('amenities.id', $id));
                }
            })
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $term = '%'.$request->string('search').'%';
                $q->where(function (Builder $inner) use ($term) {
                    $inner->where('name', 'like', $term)
                        ->orWhere('neighborhood', 'like', $term)
                        ->orWhere('city', 'like', $term);
                });
            });
    }

    /**
     * @return array<string, mixed>
     */
    public static function filterOptions(): array
    {
        $cities = Property::query()
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $maxRent = (int) Property::query()
            ->join('units', 'units.property_id', '=', 'properties.id')
            ->where('units.status', 'available')
            ->max('units.rent');

        return [
            'cities' => $cities,
            'types' => self::TYPES,
            'beds' => [0, 1, 2, 3, 4, 5],
            'baths' => [1, 1.5, 2, 2.5, 3, 3.5, 4],
            'max_price' => max($maxRent, 2000),
        ];
    }
}
