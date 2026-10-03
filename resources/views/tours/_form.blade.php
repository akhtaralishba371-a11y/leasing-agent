@csrf
@php $statuses = ['scheduled', 'completed', 'cancelled', 'no_show']; @endphp
<div class="grid">
    <div>
        <label>Lead</label>
        <select name="lead_id" required>
            <option value="">— Select lead —</option>
            @foreach ($leads as $l)
                <option value="{{ $l->id }}" @selected(old('lead_id', $tour->lead_id ?? '') == $l->id)>{{ $l->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Unit</label>
        <select name="unit_id" required>
            <option value="">— Select unit —</option>
            @foreach ($units as $u)
                <option value="{{ $u->id }}" @selected(old('unit_id', $tour->unit_id ?? '') == $u->id)>#{{ $u->unit_number }} — {{ $u->property?->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Scheduled At</label>
        <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', isset($tour->scheduled_at) ? $tour->scheduled_at->format('Y-m-d\TH:i') : '') }}" required>
    </div>
    <div>
        <label>Status</label>
        <select name="status" required>
            @foreach ($statuses as $s)
                <option value="{{ $s }}" @selected(old('status', $tour->status ?? 'scheduled') === $s)>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
            @endforeach
        </select>
    </div>
</div>
<label>Notes</label>
<textarea name="notes" rows="3">{{ old('notes', $tour->notes ?? '') }}</textarea>

<div style="margin-top:18px" class="actions">
    <button class="btn">{{ $submit ?? 'Save' }}</button>
    <a href="{{ route('tours.index') }}" class="btn secondary">Cancel</a>
</div>
