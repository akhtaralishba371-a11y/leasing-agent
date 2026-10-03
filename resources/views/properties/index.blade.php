@extends('layouts.app')
@section('title', 'Properties')
@section('content')
<div class="card">
    <div class="head">
        <h1>Properties</h1>
        <a href="{{ route('properties.create') }}" class="btn">+ New Property</a>
    </div>

    @include('partials.property-filters', [
        'options' => $options,
        'amenities' => $amenities,
        'filters' => request()->only(['city', 'property_type', 'beds', 'baths', 'min_price', 'max_price', 'amenities', 'search']),
    ])

    @forelse ($properties as $property)
    @if ($loop->first)
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Type</th>
                <th>Price / mo</th>
                <th>Units</th>
                <th>Featured</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    @endif
            <tr>
                <td><a href="{{ route('properties.show', $property) }}">{{ $property->name }}</a></td>
                <td class="muted">{{ $property->city }}, {{ $property->state }}</td>
                <td class="muted">{{ $property->property_type ? \App\Support\PropertyFilter::TYPES[$property->property_type] ?? $property->property_type : '—' }}</td>
                @php $displayPrice = $property->price ?? $property->min_rent; @endphp
                <td class="muted">{{ $displayPrice ? '$'.number_format($displayPrice) : '—' }}</td>
                <td>{{ $property->units_count }}</td>
                <td>{{ $property->featured ? 'Yes' : 'No' }}</td>
                <td class="actions">
                    <a href="{{ route('properties.edit', $property) }}" class="btn secondary sm">Edit</a>
                    <form class="inline" method="POST" action="{{ route('properties.destroy', $property) }}" onsubmit="return confirm('Delete this property?')">
                        @csrf @method('DELETE')
                        <button class="btn danger sm">Delete</button>
                    </form>
                </td>
            </tr>
    @if ($loop->last)
        </tbody>
    </table>
    @endif
    @empty
    <div class="empty">No properties match your filters.</div>
    @endforelse

    <div style="margin-top:16px">{{ $properties->links() }}</div>
</div>
@endsection
