@extends('layouts.app')
@section('title', 'Edit Lease')
@section('content')
<div class="card">
    <div class="head"><h1>Edit Lease</h1></div>
    <form method="POST" action="{{ route('leases.update', $lease) }}">
        @method('PUT')
        @include('leases._form', ['submit' => 'Update Lease'])
    </form>
</div>
@endsection
