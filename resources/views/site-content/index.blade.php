@extends('layouts.app')
@section('title', 'Site Content')
@section('content')
<div class="card">
    <div class="head"><h1>Site Content</h1></div>
    <p class="muted" style="margin-top:-8px">Edit the text and content shown on each page of the public website.</p>

    @if ($groups->isEmpty())
        <div class="empty">No editable content has been set up yet. Run <code>php artisan db:seed --class=SiteContentSeeder</code>.</div>
    @else
    <table>
        <thead><tr><th>Page</th><th>Editable fields</th><th></th></tr></thead>
        <tbody>
            @foreach ($groups as $group => $count)
            <tr>
                <td><strong>{{ $labels[$group] ?? ucfirst($group) }}</strong></td>
                <td class="muted">{{ $count }}</td>
                <td class="actions">
                    <a href="{{ route('site-content.edit', $group) }}" class="btn secondary sm">Edit content</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
