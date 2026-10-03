@extends('layouts.app')
@section('title', 'Units')
@section('content')
<div class="card">
    <div class="head">
        <h1>Units</h1>
        <a href="{{ route('units.create') }}" class="btn">+ New Unit</a>
    </div>

    @forelse ($units as $unit)
    @if ($loop->first)
    <table>
        <thead><tr><th>Unit</th><th>Property</th><th>Beds/Baths</th><th>Rent</th><th>Status</th><th></th></tr></thead>
        <tbody>
    @endif
            <tr>
                <td><a href="{{ route('units.show', $unit) }}">#{{ $unit->unit_number }}</a></td>
                <td class="muted">{{ $unit->property?->name }}</td>
                <td>{{ $unit->bedrooms }}bd / {{ $unit->bathrooms }}ba</td>
                <td>${{ number_format($unit->rent) }}</td>
                <td><span class="badge">{{ $unit->status }}</span></td>
                <td class="actions">
                    <a href="{{ route('units.edit', $unit) }}" class="btn secondary sm">Edit</a>
                    <form class="inline" method="POST" action="{{ route('units.destroy', $unit) }}" onsubmit="return confirm('Delete this unit?')">
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
    <div class="empty">No units yet.</div>
    @endforelse

    <div style="margin-top:16px">{{ $units->links() }}</div>
</div>
@endsection
