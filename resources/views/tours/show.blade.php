@extends('layouts.app')
@section('title', 'Tour')
@section('content')
<div class="card">
    <div class="head">
        <h1>Tour Details</h1>
        <a href="{{ route('tours.edit', $tour) }}" class="btn secondary">Edit</a>
    </div>
    <dl>
        <dt>Lead</dt><dd><a href="{{ route('leads.show', $tour->lead) }}">{{ $tour->lead?->name }}</a></dd>
        <dt>Unit</dt><dd><a href="{{ route('units.show', $tour->unit) }}">#{{ $tour->unit?->unit_number }}</a> · {{ $tour->unit?->property?->name }}</dd>
        <dt>Scheduled At</dt><dd>{{ $tour->scheduled_at->format('l, M j, Y · g:i A') }}</dd>
        <dt>Status</dt><dd><span class="badge">{{ $tour->status }}</span></dd>
        <dt>Notes</dt><dd>{{ $tour->notes ?: '—' }}</dd>
    </dl>
</div>
@endsection
