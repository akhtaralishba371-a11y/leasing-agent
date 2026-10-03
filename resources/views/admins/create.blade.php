@extends('layouts.app')
@section('title', 'New Admin')
@section('content')
<div class="card">
    <div class="head"><h1>New Admin</h1></div>
    <form method="POST" action="{{ route('admins.store') }}">
        @include('admins._form', ['submit' => 'Create Admin'])
    </form>
</div>
@endsection
