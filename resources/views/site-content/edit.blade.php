@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="card">
    <div class="head">
        <h1>{{ $title }}</h1>
        <a href="{{ route('site-content.index') }}" class="btn secondary">← All pages</a>
    </div>

    <form method="POST" action="{{ route('site-content.update', $group) }}">
        @csrf
        @method('PUT')

        @foreach ($items as $item)
        <div style="margin-bottom:6px">
            <label>{{ $item->label }}</label>
            @if ($item->type === 'textarea' || $item->type === 'html')
                <textarea name="content[{{ $item->id }}]" rows="{{ $item->type === 'html' ? 6 : 3 }}">{{ $item->value }}</textarea>
            @else
                <input name="content[{{ $item->id }}]" value="{{ $item->value }}">
            @endif
        </div>
        @endforeach

        <div style="margin-top:18px" class="actions">
            <button class="btn">Save Changes</button>
            <a href="{{ route('home') }}" target="_blank" class="btn secondary">View website</a>
        </div>
    </form>
</div>
@endsection
