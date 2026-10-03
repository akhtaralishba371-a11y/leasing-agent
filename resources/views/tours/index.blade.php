@extends('layouts.app')
@section('title', 'Tours')
@section('content')
<div class="card">
    <div class="head">
        <h1>Tours</h1>
        <a href="{{ route('tours.create') }}" class="btn">+ Schedule Tour</a>
    </div>

    @forelse ($tours as $tour)
    @if ($loop->first)
    <table>
        <thead><tr><th>Lead</th><th>Unit</th><th>Scheduled</th><th>Status</th><th></th></tr></thead>
        <tbody>
    @endif
            <tr>
                <td><a href="{{ route('tours.show', $tour) }}">{{ $tour->lead?->name }}</a></td>
                <td class="muted">#{{ $tour->unit?->unit_number }} · {{ $tour->unit?->property?->name }}</td>
                <td>{{ $tour->scheduled_at->format('M j, Y g:i A') }}</td>
                <td><span class="badge">{{ $tour->status }}</span></td>
                <td class="actions">
                    <a href="{{ route('tours.edit', $tour) }}" class="btn secondary sm">Edit</a>
                    <form class="inline" method="POST" action="{{ route('tours.destroy', $tour) }}" onsubmit="return confirm('Delete this tour?')">
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
    <div class="empty">No tours scheduled.</div>
    @endforelse

    <div style="margin-top:16px">{{ $tours->links() }}</div>
</div>
@endsection
