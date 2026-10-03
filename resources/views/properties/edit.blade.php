@extends('layouts.app')
@section('title', 'Edit Property')
@section('content')
<div class="card">
    <div class="head"><h1>Edit Property</h1></div>
    <form method="POST" action="{{ route('properties.update', $property) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('properties._form', ['submit' => 'Update Property'])
    </form>
</div>
@endsection
