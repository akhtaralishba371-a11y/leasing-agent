@extends('layouts.app')
@section('title', 'Edit Lead')
@section('content')
<div class="card">
    <div class="head"><h1>Edit {{ $lead->name }}</h1></div>
    <form method="POST" action="{{ route('leads.update', $lead) }}">
        @method('PUT')
        @include('leads._form', ['submit' => 'Update Lead'])
    </form>
</div>
@endsection
