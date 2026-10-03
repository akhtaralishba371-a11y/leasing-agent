@extends('layouts.app')
@section('title', 'New Lease')
@section('content')
<div class="card">
    <div class="head"><h1>New Lease</h1></div>
    <form method="POST" action="{{ route('leases.store') }}">
        @include('leases._form', ['submit' => 'Create Lease'])
    </form>
</div>
@endsection
