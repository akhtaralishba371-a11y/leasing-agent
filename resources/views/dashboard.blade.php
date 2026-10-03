@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
@php
    $leadMax = max(1, (int) $leadsByStatus->max());
    $unitMax = max(1, (int) $unitsByStatus->max());
    $occupancy = $stats['units'] > 0
        ? round((($stats['units'] - $stats['available_units']) / $stats['units']) * 100)
        : 0;
    $icons = [
        'properties' => '<path d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V10.5Z"/><path d="M9 22v-7h6v7"/>',
        'units' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h2M14 7h2M8 11h2M14 11h2M8 15h2M14 15h2"/>',
        'available' => '<circle cx="12" cy="12" r="9"/><path d="m8 12 2.5 2.5L16 9"/>',
        'leads' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/>',
        'tours' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/><path d="m9 15 2 2 4-4"/>',
        'leases' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6M8 13h8M8 17h6"/>',
    ];
@endphp

<div class="dash">
    <section class="dash-hero">
        <div class="dash-hero__glow"></div>
        <div class="dash-hero__copy">
            <span class="dash-kicker"><i></i> Leasing overview</span>
            <h1>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ auth()->user()?->name ?? 'Admin' }}.</h1>
            <p>Here’s what’s happening across your portfolio today.</p>
            <div class="dash-actions">
                <a href="{{ route('properties.create') }}">+ Add property</a>
                <a class="ghost" href="{{ route('leads.create') }}">+ New lead</a>
            </div>
        </div>
        <div class="revenue-card">
            <div class="revenue-card__top"><span>Monthly recurring revenue</span><b>Live</b></div>
            <strong>${{ number_format($monthlyRevenue, 0) }}</strong>
            <p>Generated from {{ $stats['active_leases'] }} active {{ Str::plural('lease', $stats['active_leases']) }}</p>
            <div class="revenue-meter"><span style="width:{{ min(100, max(8, $occupancy)) }}%"></span></div>
            <div class="revenue-meta"><span>Portfolio occupancy</span><b>{{ $occupancy }}%</b></div>
        </div>
    </section>

    <section class="metric-grid">
        @foreach ([
            ['properties', 'Properties', $stats['properties'], route('properties.index'), 'orange'],
            ['units', 'Total units', $stats['units'], route('units.index'), 'violet'],
            ['available', 'Available now', $stats['available_units'], route('units.index'), 'green'],
            ['leads', 'Total leads', $stats['leads'], route('leads.index'), 'blue'],
            ['tours', 'Upcoming tours', $stats['upcoming_tours'], route('tours.index'), 'amber'],
            ['leases', 'Active leases', $stats['active_leases'], route('leases.index'), 'rose'],
        ] as [$key, $label, $value, $url, $tone])
            <a class="metric metric--{{ $tone }}" href="{{ $url }}">
                <span class="metric__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $icons[$key] !!}</svg></span>
                <span class="metric__arrow">↗</span>
                <strong>{{ number_format($value) }}</strong>
                <span class="metric__label">{{ $label }}</span>
            </a>
        @endforeach
    </section>

    <section class="dash-grid dash-grid--analytics">
        <article class="dash-card">
            <header class="dash-card__head"><div><span>Pipeline</span><h2>Leads by status</h2></div><a href="{{ route('leads.index') }}">View all</a></header>
            <div class="progress-list">
                @forelse ($leadsByStatus as $status => $total)
                    <div class="progress-item">
                        <div><span class="status-dot status-dot--{{ Str::slug($status) }}"></span><b>{{ Str::headline($status) }}</b><strong>{{ $total }}</strong></div>
                        <div class="progress-track"><span style="width:{{ max(5, round(($total / $leadMax) * 100)) }}%"></span></div>
                    </div>
                @empty <div class="dash-empty">No leads yet.</div> @endforelse
            </div>
        </article>

        <article class="dash-card">
            <header class="dash-card__head"><div><span>Inventory</span><h2>Units by status</h2></div><a href="{{ route('units.index') }}">Manage</a></header>
            <div class="progress-list progress-list--units">
                @forelse ($unitsByStatus as $status => $total)
                    <div class="progress-item">
                        <div><span class="status-dot status-dot--{{ Str::slug($status) }}"></span><b>{{ Str::headline($status) }}</b><strong>{{ $total }}</strong></div>
                        <div class="progress-track"><span style="width:{{ max(5, round(($total / $unitMax) * 100)) }}%"></span></div>
                    </div>
                @empty <div class="dash-empty">No units yet.</div> @endforelse
            </div>
        </article>
    </section>

    <section class="dash-grid">
        <article class="dash-card">
            <header class="dash-card__head"><div><span>Schedule</span><h2>Upcoming tours</h2></div><a href="{{ route('tours.index') }}">Calendar</a></header>
            <div class="activity-list">
                @forelse ($upcomingTours as $tour)
                    <a class="activity" href="{{ route('tours.show', $tour) }}">
                        <time><b>{{ $tour->scheduled_at->format('d') }}</b><span>{{ $tour->scheduled_at->format('M') }}</span></time>
                        <span class="activity__body"><b>{{ $tour->lead?->name ?: 'Guest tour' }}</b><small>{{ $tour->unit?->property?->name ?: 'Property' }} · Unit #{{ $tour->unit?->unit_number }}</small></span>
                        <span class="activity__time">{{ $tour->scheduled_at->format('g:i A') }}</span>
                    </a>
                @empty <div class="dash-empty">No upcoming tours scheduled.</div> @endforelse
            </div>
        </article>

        <article class="dash-card">
            <header class="dash-card__head"><div><span>CRM activity</span><h2>Recent leads</h2></div><a href="{{ route('leads.index') }}">View all</a></header>
            <div class="activity-list">
                @forelse ($recentLeads as $lead)
                    <a class="activity activity--lead" href="{{ route('leads.show', $lead) }}">
                        <span class="avatar">{{ Str::upper(Str::substr($lead->name, 0, 1)) }}</span>
                        <span class="activity__body"><b>{{ $lead->name }}</b><small>{{ $lead->email ?: 'No email provided' }}</small></span>
                        <span class="lead-status">{{ Str::headline($lead->status) }}</span>
                    </a>
                @empty <div class="dash-empty">No leads yet.</div> @endforelse
            </div>
        </article>
    </section>
</div>

<style>
.dash{--orange:#d05f28;--navy:#111827;--soft:#f7f4f0;display:grid;gap:22px}.dash-hero{position:relative;isolation:isolate;overflow:hidden;display:grid;grid-template-columns:minmax(0,1.3fr) minmax(310px,.7fr);align-items:center;gap:38px;padding:42px;border-radius:28px;background:linear-gradient(125deg,#111827 0%,#192235 58%,#27202a 100%);color:#fff;box-shadow:0 26px 70px -35px rgba(15,23,42,.65)}.dash-hero__glow{position:absolute;z-index:-1;width:460px;height:460px;border-radius:50%;right:18%;top:-310px;background:rgba(208,95,40,.52);filter:blur(30px)}.dash-kicker{display:inline-flex;align-items:center;gap:9px;color:#fdc7a7;text-transform:uppercase;letter-spacing:.14em;font-size:11px;font-weight:800}.dash-kicker i{width:7px;height:7px;border-radius:50%;background:#f28a50;box-shadow:0 0 0 6px rgba(242,138,80,.13)}.dash-hero h1{font-family:Georgia,serif;font-size:clamp(30px,3.3vw,47px);font-weight:400;line-height:1.08;max-width:650px;margin:15px 0 12px;letter-spacing:-.025em}.dash-hero__copy>p{margin:0;color:#aeb8c9;font-size:15px}.dash-actions{display:flex;gap:10px;margin-top:25px}.dash-actions a{padding:11px 16px;border-radius:11px;background:var(--orange);color:#fff;font-size:13px;font-weight:800;transition:.2s}.dash-actions a:hover{background:#e36b31;color:#fff;transform:translateY(-2px)}.dash-actions .ghost{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.13)}.revenue-card{padding:24px;border:1px solid rgba(255,255,255,.13);border-radius:21px;background:rgba(255,255,255,.075);backdrop-filter:blur(14px);box-shadow:inset 0 1px rgba(255,255,255,.08)}.revenue-card__top,.revenue-meta{display:flex;justify-content:space-between;align-items:center;gap:12px;color:#bdc6d5;font-size:11px;text-transform:uppercase;letter-spacing:.07em;font-weight:700}.revenue-card__top b{padding:4px 8px;border-radius:99px;background:rgba(34,197,94,.14);color:#86efac;font-size:9px}.revenue-card>strong{display:block;margin-top:15px;font-size:clamp(34px,4vw,48px);line-height:1;letter-spacing:-.04em}.revenue-card>p{color:#9da8ba;font-size:12px;margin:8px 0 22px}.revenue-meter{height:7px;border-radius:99px;background:rgba(255,255,255,.1);overflow:hidden;margin-bottom:10px}.revenue-meter span{display:block;height:100%;border-radius:inherit;background:linear-gradient(90deg,#d05f28,#f4aa73)}.revenue-meta b{color:#fff}.metric-grid{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:13px}.metric{--tone:#d05f28;position:relative;min-width:0;padding:20px 18px;border-radius:18px;background:#fff;border:1px solid #e9e5e0;color:#111827;box-shadow:0 12px 30px -24px rgba(15,23,42,.45);transition:.25s}.metric:hover{color:#111827;border-color:color-mix(in srgb,var(--tone) 38%,#fff);transform:translateY(-4px);box-shadow:0 20px 38px -25px color-mix(in srgb,var(--tone) 45%,transparent)}.metric--violet{--tone:#7c3aed}.metric--green{--tone:#16a34a}.metric--blue{--tone:#2563eb}.metric--amber{--tone:#d97706}.metric--rose{--tone:#e11d48}.metric__icon{display:grid;place-items:center;width:38px;height:38px;border-radius:12px;background:color-mix(in srgb,var(--tone) 10%,#fff);color:var(--tone)}.metric__icon svg{width:20px;height:20px}.metric__arrow{position:absolute;right:16px;top:17px;color:#b1b6c0}.metric>strong{display:block;margin-top:24px;font-size:29px;line-height:1;letter-spacing:-.035em}.metric__label{display:block;color:#7b8492;font-size:11px;font-weight:750;text-transform:uppercase;letter-spacing:.045em;margin-top:8px}.dash-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}.dash-card{background:#fff;border:1px solid #e9e5e0;border-radius:22px;padding:24px;box-shadow:0 18px 48px -38px rgba(15,23,42,.5)}.dash-card__head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:22px}.dash-card__head span{display:block;color:#9a7d6c;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.13em;margin-bottom:5px}.dash-card__head h2{font-size:18px;margin:0;color:#18202e}.dash-card__head>a{color:#7c675a;background:#faf8f5;border:1px solid #eee8e2;border-radius:99px;padding:7px 11px;font-size:11px;font-weight:750}.progress-list{display:grid;gap:17px}.progress-item>div:first-child{display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:9px;font-size:13px}.progress-item strong{font-size:12px;color:#596273}.status-dot{width:8px;height:8px;border-radius:50%;background:#64748b}.status-dot--new,.status-dot--available,.status-dot--active{background:#22c55e}.status-dot--contacted,.status-dot--pending{background:#f59e0b}.status-dot--qualified,.status-dot--leased{background:#3b82f6}.status-dot--lost,.status-dot--inactive,.status-dot--maintenance{background:#ef4444}.progress-track{height:7px;margin-top:8px;background:#f0ede9;border-radius:99px;overflow:hidden}.progress-track span{display:block;height:100%;border-radius:inherit;background:linear-gradient(90deg,#d05f28,#eea06f)}.progress-list--units .progress-track span{background:linear-gradient(90deg,#334155,#7c8da5)}.activity-list{display:grid}.activity{display:flex;align-items:center;gap:13px;padding:13px 3px;color:#18202e;border-bottom:1px solid #f0ede9;transition:.2s}.activity:last-child{border-bottom:0}.activity:hover{color:#18202e;padding-left:8px}.activity time{flex:0 0 45px;height:49px;display:grid;place-content:center;text-align:center;border-radius:12px;background:#fff4ed;color:#b54c1d}.activity time b{font-size:17px;line-height:1}.activity time span{text-transform:uppercase;font-size:9px;font-weight:800;margin-top:3px}.activity__body{min-width:0;flex:1}.activity__body b,.activity__body small{display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.activity__body b{font-size:13px}.activity__body small{margin-top:4px;color:#8a929f;font-size:11px}.activity__time{font-size:11px;color:#677180;font-weight:750}.avatar{display:grid;place-items:center;flex:0 0 43px;height:43px;border-radius:13px;background:linear-gradient(135deg,#1e293b,#475569);color:#fff;font-size:14px;font-weight:800}.lead-status{padding:5px 8px;border-radius:99px;background:#f2f5f9;color:#586477;font-size:9px;font-weight:800;text-transform:uppercase;letter-spacing:.04em}.dash-empty{display:grid;place-items:center;min-height:130px;color:#9aa1ac;font-size:13px;border:1px dashed #ded8d1;border-radius:15px;background:#fcfbfa}@media(max-width:1100px){.metric-grid{grid-template-columns:repeat(3,1fr)}}@media(max-width:760px){.dash-hero{grid-template-columns:1fr;padding:28px}.metric-grid{grid-template-columns:repeat(2,1fr)}.dash-grid{grid-template-columns:1fr}}@media(max-width:440px){.metric-grid{grid-template-columns:1fr}.dash-actions{flex-wrap:wrap}.activity__time{display:none}}
</style>
@endsection
