@extends('layouts.app')
@section('title', 'Leases')
@section('content')
<div class="card">
    <div class="head">
        <h1>Leases</h1>
        <a href="{{ route('leases.create') }}" class="btn">+ New Lease</a>
    </div>

    @forelse ($leases as $lease)
    @if ($loop->first)
    <table>
        <thead><tr><th>Lead</th><th>Unit</th><th>Term</th><th>Rent</th><th>Status</th><th></th></tr></thead>
        <tbody>
    @endif
            <tr>
                <td><a href="{{ route('leases.show', $lease) }}">{{ $lease->lead?->name }}</a></td>
                <td class="muted">#{{ $lease->unit?->unit_number }} · {{ $lease->unit?->property?->name }}</td>
                <td class="muted">{{ $lease->start_date->format('M j, Y') }} → {{ $lease->end_date->format('M j, Y') }}</td>
                <td>${{ number_format($lease->rent) }}</td>
                <td><span class="badge">{{ $lease->status }}</span></td>
                <td class="actions">
                    <a href="{{ route('leases.edit', $lease) }}" class="btn secondary sm">Edit</a>
                    <form class="inline" method="POST" action="{{ route('leases.destroy', $lease) }}" onsubmit="return confirm('Delete this lease?')">
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
    <div class="empty">No leases yet.</div>
    @endforelse

    <div style="margin-top:16px">{{ $leases->links() }}</div>
</div>
@endsection
