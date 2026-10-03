@extends('layouts.app')
@section('title', 'Edit Amenity')
@section('content')
<div class="card">
    <div class="head"><h1>Edit Amenity</h1></div>
    <form method="POST" action="{{ route('amenities.update', $amenity) }}">
        @csrf @method('PUT')
        <label>Name</label>
        <input name="name" value="{{ old('name', $amenity->name) }}" required>
        <div style="margin-top:18px" class="actions">
            <button class="btn">Update Amenity</button>
            <a href="{{ route('amenities.index') }}" class="btn secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
