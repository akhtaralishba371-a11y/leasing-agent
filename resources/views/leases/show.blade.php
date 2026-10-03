@extends('layouts.app')
@section('title', 'Lease')
@section('content')
<div class="card">
    <div class="head">
        <h1>Lease Details</h1>
        <a href="{{ route('leases.edit', $lease) }}" class="btn secondary">Edit</a>
    </div>
    <dl>
        <dt>Lead</dt><dd><a href="{{ route('leads.show', $lease->lead) }}">{{ $lease->lead?->name }}</a></dd>
        <dt>Unit</dt><dd><a href="{{ route('units.show', $lease->unit) }}">#{{ $lease->unit?->unit_number }}</a> · {{ $lease->unit?->property?->name }}</dd>
        <dt>Term</dt><dd>{{ $lease->start_date->format('M j, Y') }} → {{ $lease->end_date->format('M j, Y') }}</dd>
        <dt>Rent</dt><dd>${{ number_format($lease->rent, 2) }}/mo</dd>
        <dt>Deposit</dt><dd>{{ $lease->deposit ? '$'.number_format($lease->deposit, 2) : '—' }}</dd>
        <dt>Status</dt><dd><span class="badge">{{ $lease->status }}</span></dd>
        <dt>Signed At</dt><dd>{{ $lease->signed_at?->format('M j, Y') ?: '—' }}</dd>
    </dl>
</div>
@endsection
