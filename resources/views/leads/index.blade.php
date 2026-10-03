@extends('layouts.app')
@section('title', 'Leads')
@section('content')
<div class="card">
    <div class="head">
        <h1>Leads</h1>
        <a href="{{ route('leads.create') }}" class="btn">+ New Lead</a>
    </div>

    @php
        $tabs = [
            '' => ['All', $counts['all']],
            'inquiry' => ['Property Inquiries', $counts['inquiry']],
            'review' => ['Reviews', $counts['review']],
            'agent' => ['Agent Applications', $counts['agent']],
            'manual' => ['Manual', $counts['manual']],
        ];
        $sourceMeta = [
            'website property detail' => ['Inquiry', '#1a73e8', '#e8f0fe'],
            'website property review' => ['Review', '#b06000', '#fff4e5'],
            'leasing agent application' => ['Agent App', '#6f42c1', '#f0ebfa'],
        ];
    @endphp

    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px">
        @foreach ($tabs as $key => [$label, $count])
            <a href="{{ route('leads.index', array_filter(['type' => $key])) }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:7px 14px;border-radius:999px;text-decoration:none;font-size:14px;font-weight:600;border:1px solid {{ ($type ?? '') === $key ? '#1a73e8' : '#e2e5ea' }};background:{{ ($type ?? '') === $key ? '#1a73e8' : '#fff' }};color:{{ ($type ?? '') === $key ? '#fff' : '#444' }}">
                {{ $label }}
                <span style="font-size:12px;padding:1px 8px;border-radius:999px;background:{{ ($type ?? '') === $key ? 'rgba(255,255,255,.25)' : '#f0f1f4' }};color:{{ ($type ?? '') === $key ? '#fff' : '#666' }}">{{ $count }}</span>
            </a>
        @endforeach
    </div>

    @forelse ($leads as $lead)
    @if ($loop->first)
    <table>
        <thead><tr><th>Name</th><th>Contact</th><th>Source</th><th>Status</th><th></th></tr></thead>
        <tbody>
    @endif
            <tr>
                <td><a href="{{ route('leads.show', $lead) }}">{{ $lead->name }}</a></td>
                <td class="muted">{{ $lead->email ?: $lead->phone ?: '—' }}</td>
                <td>
                    @php $meta = $sourceMeta[$lead->source] ?? null; @endphp
                    @if ($meta)
                        <span style="display:inline-block;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:600;color:{{ $meta[1] }};background:{{ $meta[2] }}">{{ $meta[0] }}</span>
                    @else
                        <span style="display:inline-block;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:600;color:#666;background:#f0f1f4">{{ $lead->source ?: 'Manual' }}</span>
                    @endif
                </td>
                <td><span class="badge">{{ $lead->status }}</span></td>
                <td class="actions">
                    <a href="{{ route('leads.edit', $lead) }}" class="btn secondary sm">Edit</a>
                    <form class="inline" method="POST" action="{{ route('leads.destroy', $lead) }}" onsubmit="return confirm('Delete this lead?')">
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
    <div class="empty">No leads in this view.</div>
    @endforelse

    <div style="margin-top:16px">{{ $leads->links() }}</div>
</div>
@endsection
