@extends('layouts.app')
@section('title', 'Edit Unit')
@section('content')
<div class="card">
    <div class="head"><h1>Edit Unit #{{ $unit->unit_number }}</h1></div>
    <form method="POST" action="{{ route('units.update', $unit) }}">
        @method('PUT')
        @include('units._form', ['submit' => 'Update Unit'])
    </form>
</div>
@endsection
