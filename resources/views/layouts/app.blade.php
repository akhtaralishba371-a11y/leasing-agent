<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Leasing Agent')</title>
    <style>
        :root {
            --bg:#f4f6fb;
            --card:#fff;
            --line:#e5e9f2;
            --primary:#2563eb;
            --primary-dark:#1d4ed8;
            --ink:#111827;
            --muted:#6b7280;
            --danger:#dc2626;
            --success:#16a34a;
            --sidebar:#0f172a;
            --sidebar-soft:#172033;
        }
        * { box-sizing: border-box; }
        body { margin:0; font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, sans-serif; background:var(--bg); color:var(--ink); }
        a { color:var(--primary); text-decoration:none; }
        a:hover { color:var(--primary-dark); }
        .admin-shell { min-height:100vh; display:grid; grid-template-columns:280px minmax(0, 1fr); }
        .admin-sidebar { background:linear-gradient(180deg, var(--sidebar) 0%, #111827 100%); color:#fff; padding:24px 18px; display:flex; flex-direction:column; position:sticky; top:0; height:100vh; box-shadow:18px 0 40px rgba(15,23,42,.08); }
        .admin-brand { display:flex; align-items:center; gap:12px; color:#fff; padding:0 8px 22px; border-bottom:1px solid rgba(255,255,255,.1); margin-bottom:20px; }
        .admin-brand-mark { display:grid; place-items:center; width:38px; height:38px; border-radius:10px; background:#fff; color:var(--primary); font-weight:800; box-shadow:0 10px 28px rgba(37,99,235,.28); }
        .admin-brand-title { display:block; font-size:16px; font-weight:800; line-height:1.15; }
        .admin-brand-subtitle { display:block; color:#94a3b8; font-size:12px; margin-top:3px; }
        .admin-nav { display:flex; flex-direction:column; gap:7px; }
        .admin-nav a { color:#cbd5e1; text-decoration:none; padding:12px 13px; border-radius:10px; font-size:14px; font-weight:650; display:flex; align-items:center; justify-content:space-between; transition:background .15s ease, color .15s ease, transform .15s ease; }
        .admin-nav a:hover, .admin-nav a.active { color:#fff; background:rgba(37,99,235,.24); }
        .admin-nav a.active { box-shadow:inset 3px 0 0 #60a5fa; }
        .admin-nav a:hover { transform:translateX(2px); }
        .admin-footer { margin-top:auto; border-top:1px solid rgba(255,255,255,.1); padding-top:16px; }
        .admin-user { color:#e5e7eb; font-size:13px; padding:0 10px 12px; }
        .admin-user span { display:block; color:#94a3b8; font-size:11px; text-transform:uppercase; letter-spacing:.08em; margin-bottom:4px; }
        .logout { width:100%; text-align:left; background:var(--sidebar-soft); border:1px solid rgba(255,255,255,.08); color:#cbd5e1; cursor:pointer; font-size:14px; padding:11px 12px; border-radius:10px; font-family:inherit; }
        .logout:hover { color:#fff; background:rgba(239,68,68,.16); border-color:rgba(239,68,68,.35); }
        .admin-main { min-width:0; }
        .topbar { min-height:72px; display:flex; align-items:center; justify-content:space-between; gap:18px; padding:0 34px; background:rgba(255,255,255,.8); border-bottom:1px solid var(--line); backdrop-filter:blur(14px); position:sticky; top:0; z-index:5; }
        .topbar-title { font-size:18px; font-weight:800; }
        .topbar-subtitle { color:var(--muted); font-size:13px; margin-top:2px; }
        .topbar-action { color:#334155; font-size:13px; background:#fff; border:1px solid var(--line); border-radius:999px; padding:9px 13px; box-shadow:0 8px 22px rgba(15,23,42,.05); }
        main { max-width:1180px; margin:28px auto 44px; padding:0 34px; }
        .card { background:var(--card); border:1px solid var(--line); border-radius:8px; padding:22px; box-shadow:0 14px 34px rgba(15,23,42,.06); }
        .head { display:flex; justify-content:space-between; align-items:center; gap:16px; margin-bottom:18px; }
        h1 { font-size:24px; letter-spacing:0; margin:0; }
        table { width:100%; border-collapse:separate; border-spacing:0; overflow:hidden; }
        th, td { text-align:left; padding:13px 14px; border-bottom:1px solid var(--line); font-size:14px; vertical-align:middle; }
        th { color:#64748b; font-weight:750; text-transform:uppercase; font-size:11px; letter-spacing:.04em; background:#f8fafc; }
        tbody tr:hover { background:#f8fbff; }
        .btn { display:inline-flex; align-items:center; justify-content:center; gap:7px; background:var(--primary); color:#fff; border:1px solid var(--primary); padding:10px 15px; border-radius:8px; text-decoration:none; font-size:14px; font-weight:700; cursor:pointer; box-shadow:0 10px 22px rgba(37,99,235,.18); transition:background .15s ease, border-color .15s ease, transform .15s ease; }
        .btn:hover { background:var(--primary-dark); border-color:var(--primary-dark); color:#fff; transform:translateY(-1px); }
        .btn.secondary { background:#fff; border-color:var(--line); color:#111827; box-shadow:none; }
        .btn.secondary:hover { background:#f8fafc; color:#111827; }
        .btn.danger { background:var(--danger); }
        .btn.danger:hover { background:#b91c1c; border-color:#b91c1c; }
        .btn.sm { padding:7px 10px; font-size:12px; border-radius:7px; }
        .actions { display:flex; flex-wrap:wrap; gap:7px; justify-content:flex-end; }
        .badge { display:inline-flex; align-items:center; padding:4px 10px; border-radius:999px; font-size:12px; font-weight:750; background:#eef2ff; color:#3730a3; text-transform:capitalize; }
        form.inline { display:inline; }
        label { display:block; font-size:13px; font-weight:750; margin:14px 0 6px; color:#334155; }
        input, select, textarea { width:100%; padding:11px 12px; border:1px solid var(--line); border-radius:8px; font-size:14px; font-family:inherit; background:#fff; color:var(--ink); outline:none; transition:border-color .15s ease, box-shadow .15s ease; }
        input:focus, select:focus, textarea:focus { border-color:#93c5fd; box-shadow:0 0 0 4px rgba(37,99,235,.1); }
        .grid { display:grid; grid-template-columns:1fr 1fr; gap:0 20px; }
        .alert { background:#ecfdf5; color:#166534; border:1px solid #bbf7d0; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px; }
        .errors { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px; }
        .errors ul { margin:6px 0 0; padding-left:18px; }
        .muted { color:var(--muted); }
        .empty { text-align:center; padding:40px; color:var(--muted); }
        dl { display:grid; grid-template-columns:160px 1fr; gap:10px 16px; font-size:14px; }
        dt { color:var(--muted); font-weight:600; }
        .property-filters { display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:12px; margin-bottom:20px; padding:16px; background:#f8fafc; border:1px solid var(--line); border-radius:8px; }
        .property-filters__select { width:100%; padding:10px 12px; border:1px solid var(--line); border-radius:8px; font-size:14px; background:#fff; }
        .property-filters__range { grid-column:1/-1; }
        .property-filters__range-head { display:flex; justify-content:space-between; margin-bottom:8px; font-size:14px; }
        .property-filters__range-label { font-weight:600; }
        .property-filters__range-value { color:var(--primary); font-weight:600; }
        .property-filters__slider { position:relative; height:28px; }
        .property-filters__range-input { position:absolute; width:100%; pointer-events:none; appearance:none; height:4px; background:#e5e7eb; border-radius:4px; top:12px; }
        .property-filters__range-input::-webkit-slider-thumb { pointer-events:auto; appearance:none; width:18px; height:18px; border-radius:50%; background:var(--primary); cursor:pointer; }
        .property-filters__amenities { grid-column:1/-1; display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:8px; }
        .property-filters__amenities-title { grid-column:1/-1; font-size:14px; margin-bottom:4px; }
        .property-filters__check { display:flex; align-items:center; gap:8px; font-size:14px; font-weight:400; }
        .property-filters__actions { grid-column:1/-1; display:flex; gap:10px; align-items:center; }
        .property-filters__btn { background:var(--primary); color:#fff; border:0; padding:10px 16px; border-radius:8px; cursor:pointer; font-size:14px; font-weight:750; }
        .property-filters__clear { font-size:14px; color:var(--muted); }
        /* mobile drawer chrome */
        .topbar-left { display:flex; align-items:center; gap:14px; min-width:0; }
        .admin-hamburger { display:none; flex:0 0 auto; width:42px; height:42px; padding:0; border:1px solid var(--line); background:#fff; border-radius:10px; cursor:pointer; flex-direction:column; align-items:center; justify-content:center; gap:5px; box-shadow:0 8px 22px rgba(15,23,42,.05); }
        .admin-hamburger span { display:block; width:20px; height:2px; background:#334155; border-radius:2px; transition:transform .3s ease, opacity .2s ease; }
        body.sidebar-open .admin-hamburger span:nth-child(1) { transform:translateY(7px) rotate(45deg); }
        body.sidebar-open .admin-hamburger span:nth-child(2) { opacity:0; }
        body.sidebar-open .admin-hamburger span:nth-child(3) { transform:translateY(-7px) rotate(-45deg); }
        .admin-overlay { position:fixed; inset:0; background:rgba(15,23,42,.5); opacity:0; visibility:hidden; transition:opacity .3s ease, visibility .3s ease; z-index:40; }
        body.sidebar-open .admin-overlay { opacity:1; visibility:visible; }
        @keyframes navIn { from { opacity:0; transform:translateX(-14px); } to { opacity:1; transform:translateX(0); } }
        @media (max-width: 820px) {
            .admin-shell { grid-template-columns:1fr; }
            .admin-hamburger { display:flex; }
            .admin-sidebar {
                position:fixed; top:0; left:0; height:100vh; width:280px; max-width:84vw;
                transform:translateX(-100%); transition:transform .34s cubic-bezier(.4,0,.2,1);
                z-index:50; box-shadow:26px 0 60px rgba(15,23,42,.45);
            }
            body.sidebar-open .admin-sidebar { transform:translateX(0); }
            body.sidebar-open .admin-nav a { animation:navIn .4s ease both; }
            .admin-nav a:nth-child(1){ animation-delay:.04s; } .admin-nav a:nth-child(2){ animation-delay:.08s; }
            .admin-nav a:nth-child(3){ animation-delay:.12s; } .admin-nav a:nth-child(4){ animation-delay:.16s; }
            .admin-nav a:nth-child(5){ animation-delay:.20s; } .admin-nav a:nth-child(6){ animation-delay:.24s; }
            .admin-nav a:nth-child(7){ animation-delay:.28s; } .admin-nav a:nth-child(8){ animation-delay:.32s; }
            .admin-nav a:nth-child(9){ animation-delay:.36s; } .admin-nav a:nth-child(10){ animation-delay:.40s; }
            .topbar { position:sticky; padding:14px 16px; align-items:center; }
            .topbar-action { display:none; }
            main { margin:18px auto; padding:0 16px; }
            .grid { grid-template-columns:1fr; }
            .head { align-items:flex-start; flex-direction:column; }
            table { display:block; overflow-x:auto; white-space:nowrap; }
        }
        @media (prefers-reduced-motion: reduce) {
            .admin-sidebar { transition:none; }
            body.sidebar-open .admin-nav a { animation:none; }
        }
    </style>
</head>
<body>
    @php $r = request()->segment(1) === 'admin' ? request()->segment(2) : request()->segment(1); @endphp
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <span class="admin-brand-mark">LA</span>
                <span>
                    <span class="admin-brand-title">Leasing Agent</span>
                    <span class="admin-brand-subtitle">Admin Panel</span>
                </span>
            </div>
            <nav class="admin-nav" aria-label="Admin navigation">
                <a href="{{ route('dashboard') }}" class="{{ $r==='dashboard'?'active':'' }}">Dashboard</a>
                <a href="{{ route('properties.index') }}" class="{{ $r==='properties'?'active':'' }}">Properties</a>
                <a href="{{ route('units.index') }}" class="{{ $r==='units'?'active':'' }}">Units</a>
                <a href="{{ route('leads.index') }}" class="{{ $r==='leads'?'active':'' }}">Leads</a>
                <a href="{{ route('tours.index') }}" class="{{ $r==='tours'?'active':'' }}">Tours</a>
                <a href="{{ route('leases.index') }}" class="{{ $r==='leases'?'active':'' }}">Leases</a>
                <a href="{{ route('amenities.index') }}" class="{{ $r==='amenities'?'active':'' }}">Amenities</a>
                <a href="{{ route('site-content.index') }}" class="{{ $r==='site-content'?'active':'' }}">Site Content</a>
                <a href="{{ route('admins.index') }}" class="{{ $r==='admins'?'active':'' }}">Admins</a>
                <a href="{{ route('home') }}" target="_blank">Website</a>
            </nav>
            <div class="admin-footer">
                <div class="admin-user"><span>Signed in</span>{{ auth()->user()?->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout">Logout</button>
                </form>
            </div>
        </aside>
        <div class="admin-main">
            <div class="topbar">
                <div>
                    <div class="topbar-title">@yield('title', 'Admin')</div>
                    <div class="topbar-subtitle">Manage listings, leads, tours, and leases.</div>
                </div>
                <a class="topbar-action" href="{{ route('home') }}" target="_blank">View website</a>
            </div>
            <main>
                @if (session('status'))
                    <div class="alert">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="errors">
                        Please fix the following:
                        <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
