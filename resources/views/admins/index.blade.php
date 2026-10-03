@extends('layouts.app')
@section('title', 'Admins')
@section('content')
<div class="card">
    <div class="head">
        <h1>Admins</h1>
        <a href="{{ route('admins.create') }}" class="btn">+ New Admin</a>
    </div>

    @forelse ($admins as $admin)
    @if ($loop->first)
    <table>
        <thead><tr><th>Name</th><th>Email</th><th>Added</th><th></th></tr></thead>
        <tbody>
    @endif
            <tr>
                <td>
                    {{ $admin->name }}
                    @if ($admin->id === auth()->id())
                        <span class="badge" style="margin-left:6px">You</span>
                    @endif
                </td>
                <td class="muted">{{ $admin->email }}</td>
                <td class="muted">{{ $admin->created_at?->format('M j, Y') }}</td>
                <td class="actions">
                    <a href="{{ route('admins.edit', $admin) }}" class="btn secondary sm">Edit</a>
                    @if ($admin->id !== auth()->id())
                    <form class="inline" method="POST" action="{{ route('admins.destroy', $admin) }}" onsubmit="return confirm('Delete this admin?')">
                        @csrf @method('DELETE')
                        <button class="btn danger sm">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
    @if ($loop->last)
        </tbody>
    </table>
    @endif
    @empty
    <div class="empty">No admins yet.</div>
    @endforelse

    <div style="margin-top:16px">{{ $admins->links() }}</div>
</div>
@endsection
