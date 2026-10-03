@extends('layouts.app')
@section('title', 'New Unit')
@section('content')
<div class="card">
    <div class="head"><h1>New Unit</h1></div>
    <form method="POST" action="{{ route('units.store') }}">
        @include('units._form', ['submit' => 'Create Unit'])
    </form>
</div>
@endsection
