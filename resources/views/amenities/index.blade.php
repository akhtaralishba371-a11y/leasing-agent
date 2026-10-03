@extends('layouts.app')
@section('title', 'Amenities')
@section('content')
<div class="card">
    <div class="head">
        <h1>Amenities</h1>
        <a href="{{ route('amenities.create') }}" class="btn">+ New Amenity</a>
    </div>

    @forelse ($amenities as $amenity)
    @if ($loop->first)
    <table>
        <thead><tr><th>Name</th><th>Properties</th><th></th></tr></thead>
        <tbody>
    @endif
            <tr>
                <td>{{ $amenity->name }}</td>
                <td class="muted">{{ $amenity->properties_count }}</td>
                <td class="actions">
                    <a href="{{ route('amenities.edit', $amenity) }}" class="btn secondary sm">Edit</a>
                    <form class="inline" method="POST" action="{{ route('amenities.destroy', $amenity) }}" onsubmit="return confirm('Delete this amenity?')">
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
    <div class="empty">No amenities yet. Add filter options for the website.</div>
    @endforelse

    <div style="margin-top:16px">{{ $amenities->links() }}</div>
</div>
@endsection
