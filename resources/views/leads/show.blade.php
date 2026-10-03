@extends('layouts.app')
@section('title', $lead->name)
@section('content')
<div class="card">
    <div class="head">
        <h1>{{ $lead->name }}</h1>
        <a href="{{ route('leads.edit', $lead) }}" class="btn secondary">Edit</a>
    </div>
    <dl>
        <dt>Status</dt><dd><span class="badge">{{ $lead->status }}</span></dd>
        <dt>Email</dt><dd>{{ $lead->email ?: '—' }}</dd>
        <dt>Phone</dt><dd>{{ $lead->phone ?: '—' }}</dd>
        <dt>Source</dt><dd>{{ $lead->source ?: '—' }}</dd>
        <dt>Desired Bedrooms</dt><dd>{{ $lead->desired_bedrooms ?? '—' }}</dd>
        <dt>Budget</dt><dd>{{ $lead->budget ? '$'.number_format($lead->budget) : '—' }}</dd>
        <dt>Desired Move-in</dt><dd>{{ $lead->desired_move_in?->format('M j, Y') ?: '—' }}</dd>
        <dt>Notes</dt><dd>{{ $lead->notes ?: '—' }}</dd>
    </dl>
</div>

<div class="card" style="margin-top:20px">
    <div class="head"><h1 style="font-size:18px">Tours ({{ $lead->tours->count() }})</h1></div>
    @forelse ($lead->tours as $tour)
    @if ($loop->first)<table><thead><tr><th>Unit</th><th>Scheduled</th><th>Status</th></tr></thead><tbody>@endif
        <tr>
            <td>{{ $tour->unit?->unit_number ? '#'.$tour->unit->unit_number : '—' }}</td>
            <td>{{ $tour->scheduled_at->format('M j, Y g:i A') }}</td>
            <td><span class="badge">{{ $tour->status }}</span></td>
        </tr>
    @if ($loop->last)</tbody></table>@endif
    @empty
    <div class="empty">No tours booked.</div>
    @endforelse
</div>
@endsection
