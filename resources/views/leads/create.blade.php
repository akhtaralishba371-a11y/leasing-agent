@extends('layouts.app')
@section('title', 'New Lead')
@section('content')
<div class="card">
    <div class="head"><h1>New Lead</h1></div>
    <form method="POST" action="{{ route('leads.store') }}">
        @include('leads._form', ['submit' => 'Create Lead'])
    </form>
</div>
@endsection
