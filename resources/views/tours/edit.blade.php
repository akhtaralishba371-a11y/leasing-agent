@extends('layouts.app')
@section('title', 'Edit Tour')
@section('content')
<div class="card">
    <div class="head"><h1>Edit Tour</h1></div>
    <form method="POST" action="{{ route('tours.update', $tour) }}">
        @method('PUT')
        @include('tours._form', ['submit' => 'Update Tour'])
    </form>
</div>
@endsection
