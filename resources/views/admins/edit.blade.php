@extends('layouts.app')
@section('title', 'Edit Admin')
@section('content')
<div class="card">
    <div class="head"><h1>Edit Admin</h1></div>
    <form method="POST" action="{{ route('admins.update', $admin) }}">
        @method('PUT')
        @include('admins._form', ['submit' => 'Update Admin'])
    </form>
</div>
@endsection
