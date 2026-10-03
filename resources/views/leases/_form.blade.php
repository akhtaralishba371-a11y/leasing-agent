@csrf
@php $statuses = ['pending', 'active', 'ended', 'terminated']; @endphp
<div class="grid">
    <div>
        <label>Lead</label>
        <select name="lead_id" required>
            <option value="">— Select lead —</option>
            @foreach ($leads as $l)
                <option value="{{ $l->id }}" @selected(old('lead_id', $lease->lead_id ?? '') == $l->id)>{{ $l->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Unit</label>
        <select name="unit_id" required>
            <option value="">— Select unit —</option>
            @foreach ($units as $u)
                <option value="{{ $u->id }}" @selected(old('unit_id', $lease->unit_id ?? '') == $u->id)>#{{ $u->unit_number }} — {{ $u->property?->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Start Date</label>
        <input type="date" name="start_date" value="{{ old('start_date', isset($lease->start_date) ? $lease->start_date->format('Y-m-d') : '') }}" required>
    </div>
    <div>
        <label>End Date</label>
        <input type="date" name="end_date" value="{{ old('end_date', isset($lease->end_date) ? $lease->end_date->format('Y-m-d') : '') }}" required>
    </div>
    <div>
        <label>Rent ($/month)</label>
        <input type="number" step="0.01" name="rent" min="0" value="{{ old('rent', $lease->rent ?? '') }}" required>
    </div>
    <div>
        <label>Deposit ($)</label>
        <input type="number" step="0.01" name="deposit" min="0" value="{{ old('deposit', $lease->deposit ?? '') }}">
    </div>
    <div>
        <label>Status</label>
        <select name="status" required>
            @foreach ($statuses as $s)
                <option value="{{ $s }}" @selected(old('status', $lease->status ?? 'pending') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Signed At</label>
        <input type="date" name="signed_at" value="{{ old('signed_at', isset($lease->signed_at) ? $lease->signed_at->format('Y-m-d') : '') }}">
    </div>
</div>

<div style="margin-top:18px" class="actions">
    <button class="btn">{{ $submit ?? 'Save' }}</button>
    <a href="{{ route('leases.index') }}" class="btn secondary">Cancel</a>
</div>
