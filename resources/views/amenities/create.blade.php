@extends('layouts.app')
@section('title', 'New Amenity')
@section('content')
<div class="card">
    <div class="head"><h1>New Amenity</h1></div>
    <form method="POST" action="{{ route('amenities.store') }}">
        @csrf
        <label>Name</label>
        <input name="name" value="{{ old('name') }}" required placeholder="e.g. Air Conditioning">
        <div style="margin-top:18px" class="actions">
            <button class="btn">Create Amenity</button>
            <a href="{{ route('amenities.index') }}" class="btn secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
