@extends('layouts.app')
@section('title', $property->name)
@section('content')
<div class="card">
    <div class="head">
        <h1>{{ $property->name }}</h1>
        <a href="{{ route('properties.edit', $property) }}" class="btn secondary">Edit</a>
    </div>
    <dl>
        <dt>Address</dt><dd>{{ $property->address }}, {{ $property->city }}, {{ $property->state }} {{ $property->zip }}</dd>
        <dt>Description</dt><dd>{{ $property->description ?: '—' }}</dd>
    </dl>
</div>

<div class="card" style="margin-top:20px">
    <div class="head"><h1 style="font-size:18px">Units ({{ $property->units->count() }})</h1></div>
    @forelse ($property->units as $unit)
    @if ($loop->first)<table><thead><tr><th>Unit</th><th>Beds/Baths</th><th>Rent</th><th>Status</th></tr></thead><tbody>@endif
        <tr>
            <td><a href="{{ route('units.show', $unit) }}">#{{ $unit->unit_number }}</a></td>
            <td>{{ $unit->bedrooms }}bd / {{ $unit->bathrooms }}ba</td>
            <td>${{ number_format($unit->rent) }}</td>
            <td><span class="badge">{{ $unit->status }}</span></td>
        </tr>
    @if ($loop->last)</tbody></table>@endif
    @empty
    <div class="empty">No units for this property.</div>
    @endforelse
</div>
@endsection
