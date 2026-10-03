@extends('layouts.app')
@section('title', 'Schedule Tour')
@section('content')
<div class="card">
    <div class="head"><h1>Schedule Tour</h1></div>
    <form method="POST" action="{{ route('tours.store') }}">
        @include('tours._form', ['submit' => 'Schedule Tour'])
    </form>
</div>
@endsection
