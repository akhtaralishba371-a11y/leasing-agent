@csrf
@php $statuses = ['new', 'contacted', 'touring', 'applied', 'leased', 'lost']; @endphp
<div class="grid">
    <div>
        <label>Name</label>
        <input name="name" value="{{ old('name', $lead->name ?? '') }}" required>
    </div>
    <div>
        <label>Status</label>
        <select name="status" required>
            @foreach ($statuses as $s)
                <option value="{{ $s }}" @selected(old('status', $lead->status ?? 'new') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $lead->email ?? '') }}">
    </div>
    <div>
        <label>Phone</label>
        <input name="phone" value="{{ old('phone', $lead->phone ?? '') }}">
    </div>
    <div>
        <label>Source</label>
        <input name="source" value="{{ old('source', $lead->source ?? '') }}" placeholder="website, referral, zillow...">
    </div>
    <div>
        <label>Desired Bedrooms</label>
        <input type="number" name="desired_bedrooms" min="0" value="{{ old('desired_bedrooms', $lead->desired_bedrooms ?? '') }}">
    </div>
    <div>
        <label>Budget ($/month)</label>
        <input type="number" step="0.01" name="budget" min="0" value="{{ old('budget', $lead->budget ?? '') }}">
    </div>
    <div>
        <label>Desired Move-in</label>
        <input type="date" name="desired_move_in" value="{{ old('desired_move_in', isset($lead->desired_move_in) ? $lead->desired_move_in->format('Y-m-d') : '') }}">
    </div>
</div>
<label>Notes</label>
<textarea name="notes" rows="3">{{ old('notes', $lead->notes ?? '') }}</textarea>

<div style="margin-top:18px" class="actions">
    <button class="btn">{{ $submit ?? 'Save' }}</button>
    <a href="{{ route('leads.index') }}" class="btn secondary">Cancel</a>
</div>
