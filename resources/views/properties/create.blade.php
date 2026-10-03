@extends('layouts.app')
@section('title', 'New Property')
@section('content')
<div class="card">
    <div class="head"><h1>New Property</h1></div>
    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
        @include('properties._form', ['submit' => 'Create Property'])
    </form>
</div>
@endsection
