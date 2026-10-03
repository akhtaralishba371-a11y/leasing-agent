@extends('layouts.app')
@section('title', 'Unit #'.$unit->unit_number)
@section('content')
<div class="card">
    <div class="head">
        <h1>Unit #{{ $unit->unit_number }}</h1>
        <a href="{{ route('units.edit', $unit) }}" class="btn secondary">Edit</a>
    </div>
    <dl>
        <dt>Property</dt><dd><a href="{{ route('properties.show', $unit->property) }}">{{ $unit->property?->name }}</a></dd>
        <dt>Bedrooms / Baths</dt><dd>{{ $unit->bedrooms }} bd / {{ $unit->bathrooms }} ba</dd>
        <dt>Square Feet</dt><dd>{{ $unit->square_feet ? number_format($unit->square_feet).' sqft' : '—' }}</dd>
        <dt>Rent</dt><dd>${{ number_format($unit->rent, 2) }}/mo</dd>
        <dt>Status</dt><dd><span class="badge">{{ $unit->status }}</span></dd>
        <dt>Available On</dt><dd>{{ $unit->available_on?->format('M j, Y') ?: '—' }}</dd>
        <dt>Description</dt><dd>{{ $unit->description ?: '—' }}</dd>
    </dl>
</div>

<div class="card" style="margin-top:20px">
    <div class="head"><h1 style="font-size:18px">Tours ({{ $unit->tours->count() }})</h1></div>
    @forelse ($unit->tours as $tour)
    @if ($loop->first)<table><thead><tr><th>Lead</th><th>Scheduled</th><th>Status</th></tr></thead><tbody>@endif
        <tr>
            <td>{{ $tour->lead?->name }}</td>
            <td>{{ $tour->scheduled_at->format('M j, Y g:i A') }}</td>
            <td><span class="badge">{{ $tour->status }}</span></td>
        </tr>
    @if ($loop->last)</tbody></table>@endif
    @empty
    <div class="empty">No tours booked.</div>
    @endforelse
</div>
@endsection
