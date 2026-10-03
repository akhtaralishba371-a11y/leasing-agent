@csrf
<div class="grid">
    <div>
        <label>Name</label>
        <input name="name" value="{{ old('name', $admin->name ?? '') }}" required>
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required>
    </div>
    <div>
        <label>Password @if (isset($admin))<span class="muted" style="font-weight:400">(leave blank to keep current)</span>@endif</label>
        <input type="password" name="password" autocomplete="new-password" @if (!isset($admin)) required @endif>
    </div>
    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" autocomplete="new-password" @if (!isset($admin)) required @endif>
    </div>
</div>

<div style="margin-top:18px" class="actions">
    <button class="btn">{{ $submit ?? 'Save' }}</button>
    <a href="{{ route('admins.index') }}" class="btn secondary">Cancel</a>
</div>
